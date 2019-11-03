<?php

namespace Therour\WpApiClient\Models;

class WpPost extends WpModel
{
    protected $resourceName = 'post';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date', 'date_gmt', 'modified', 'modified_at'];

    protected $refereceIds = ['author', 'categories', 'featured_media'];
}
