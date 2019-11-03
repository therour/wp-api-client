<?php

namespace Therour\WpApiClient\Models;

use Illuminate\Support\Traits\ForwardsCalls;
use Therour\WpApiClient\Query\Builder;

abstract class WpModel
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

    protected function setAttribute($key, $value)
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

    public function getAttribute($key)
    {
        if ($this->isReferenceId($key)) {
            $key = $key.'_id';
        }

        return $this->attributes[$key] ?? null;
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
}
