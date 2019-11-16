<?php

namespace Therour\WpApiClient\Params;

class CategoryParam extends TagParam
{
    /**
     * Specify a resource name.
     *
     * @var string
     */
    protected $resourceName = 'categories';

    /**
     * Where has parent's category id.
     *
     * @var int
     */
    protected $parent;
}
