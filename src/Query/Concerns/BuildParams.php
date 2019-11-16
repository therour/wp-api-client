<?php

namespace Therour\WpApiClient\Query\Concerns;

use Therour\WpApiClient\Params\ParamBuilder;

trait BuildParams
{
    protected $param;

    /**
     * get param instance.
     *
     * @return \Therour\WpApiClient\Params\AbstractParam
     */
    protected function param()
    {
        return $this->param ?? ($this->param = $this->newParam());
    }

    /**
     * build new param class.
     *
     * @return \Therour\WpApiClient\Params\AbstractParam
     */
    protected function newParam()
    {
        return app(ParamBuilder::class)->build($this->resourceName);
    }
}
