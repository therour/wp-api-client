<?php

namespace Therour\WpApiClient\Query\Concerns;

use Therour\WpApiClient\Param;

trait BuildParams
{
    protected $param;

    /**
     * get param instance.
     *
     * @return \Therour\WpApiClient\Param
     */
    protected function param()
    {
        return $this->param ?? ($this->param = $this->newParam());
    }

    protected function newParam()
    {
        return new Param($this->resourceName);
    }

    /**
     * Set the 'page' value to the param.
     *
     * @param int $page
     * @return void
     */
    public function page(int $page)
    {
        $this->param()->setPage($page);

        return $this;
    }
}
