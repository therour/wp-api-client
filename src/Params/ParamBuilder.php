<?php

namespace Therour\WpApiClient\Params;

class ParamBuilder
{
    /**
     * List of Param class.
     *
     * @var array
     */
    protected $params;

    /**
     * Create a new Param Builder class.
     *
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * Build a param class
     *
     * @param string $resourceName
     * @return \Therour\WpApiClient\Params\AbstractParam
     */
    public function build($resourceName)
    {
        if (array_key_exists($resourceName, $this->params));

        return new $this->params[$resourceName];
    }
}
