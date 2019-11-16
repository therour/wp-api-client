<?php

namespace Therour\WpApiClient\Query\Concerns;

use Therour\WpApiClient\Params\AbstractParam;
use Therour\WpApiClient\Contracts\WpApiExecutor;

trait BuildExecutor
{
    protected function execute(AbstractParam $param)
    {
        return $this->getExecutor()->execute($param);
    }

    protected function getExecutor()
    {
        return app(WpApiExecutor::class);
    }
}
