<?php

namespace Therour\WpApiClient\Contracts;

interface ExecutableParam
{
    /**
     * get resource name.
     *
     * @return string
     */
    public function getResourceName();

    /**
     * get all parameters.
     *
     * @return array
     */
    public function getParameters();

    /**
     * get resource id.
     *
     * @return int|null
     */
    public function getId();
}
