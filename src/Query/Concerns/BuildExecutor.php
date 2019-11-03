<?php

namespace Therour\WpApiClient\Query\Concerns;

use Therour\WpApiClient\Param;
use Illuminate\Container\Container;
use Therour\WpApiClient\Executor\WpApiExecutor;

trait BuildExecutor
{
    protected function execute(Param $param)
    {
        return $this->getExecutor()->execute($param);
    }

    protected function getExecutor()
    {
        return Container::getInstance()->make(WpApiExecutor::class);
    }
}
