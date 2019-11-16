<?php

namespace Therour\WpApiClient\Models;

class WpCategory extends WpModel
{
    /**
     * Resource name.
     *
     * @var string
     */
    protected $resourceName = 'categories';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date', 'date_gmt', 'modified', 'modified_at'];

    /**
     * Columns with reference id to another resource.
     *
     * @var array
     */
    protected $refereceIds = ['author', 'categories', 'featured_media'];
}
