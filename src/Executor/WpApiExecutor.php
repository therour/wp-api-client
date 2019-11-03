<?php

namespace Therour\WpApiClient\Executor;

use Therour\WpApiClient\Param;

interface WpApiExecutor
{
    /**
     * execute and return collection of response.
     *
     * @return \Illuminate\Support\Collection
     */
    public function execute(Param $param);
}
