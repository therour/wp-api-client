<?php

namespace Therour\WpApiClient\Models;

use ArrayAccess;
use JsonSerializable;
use Therour\WpApiClient\Query\Builder;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Traits\ForwardsCalls;

abstract class WpModel implements Arrayable, ArrayAccess, Jsonable, JsonSerializable
{
    use ForwardsCalls;

    protected $resourceName;

    protected $attributes = [];

    protected $dates = [];

    protected $referenceIds = [];

    public function __construct($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    public function setAttribute($key, $value)
    {
        if ($this->isDateAttribute($key)) {
            $value = \Illuminate\Support\Carbon::parse($value);
        } elseif ($this->isReferenceId($key)) {
            $key = $key.'_id';
        }

        $this->attributes[$key] = $value;
    }

    protected function isDateAttribute($key)
    {
        return in_array($key, $this->dates);
    }

    protected function isReferenceId($key)
    {
        return in_array($key, $this->referenceIds);
    }

    protected function getKeyName($key)
    {
        return $this->isReferenceId($key) ? $key.'_id' : $key;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$this->getKeyName($key)] ?? null;
    }

    public function attributesToArray()
    {
        return $this->attributes;
    }

    /**
     * Create query builder
     *
     * @return \Therour\WpApiClient\Query\Builder
     */
    protected function newQuery()
    {
        return tap(new Builder($this->resourceName))->setModel($this);
    }

    /**
     * Create new instance of the model.
     *
     * @param array $attributes
     * @return \Therour\WpApiClient\Models\WpModel
     */
    public function newInstance($attributes = [])
    {
        return new static($attributes);
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo($this->newQuery(), $method, $parameters);
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributesToArray();
    }

    /**
     * Convert the model instance to JSON.
     *
     * @param  int  $options
     * @return string
     *
     * @throws \Illuminate\Database\Eloquent\JsonEncodingException
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        return $json;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function offsetExists($offset)
    {
        return isset($this->attributes[$this->getKeyName($offset)]);
    }

    public function offsetGet($offset)
    {
        return $this->getAttribute($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->setAttribute($offset, $value);
    }

    public function offsetUnset($offset)
    {
        return;
    }
}
