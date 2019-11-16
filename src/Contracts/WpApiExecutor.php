<?php

namespace Therour\WpApiClient\Contracts;

use Therour\WpApiClient\Contracts\ExecutableParam;

interface WpApiExecutor
{
    /**
     * execute and return collection of response.
     *
     * @return \Illuminate\Support\Collection
     */
    public function execute(ExecutableParam $param);
}
