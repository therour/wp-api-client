<?php

namespace Therour\WpApiClient\Models;

use Illuminate\Support\Traits\ForwardsCalls;
use Therour\WpApiClient\Query\Builder;

abstract class WpModel
{
    use ForwardsCalls;

    protected $resourceName;

    protected $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
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
        return array_key_exists($key, $this->attributes) ? $this->attributes[$key] : null;
    }
}
