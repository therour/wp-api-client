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

    /**
     * Columns with reference id to another resource.
     *
     * @var array
     */
    protected $refereceIds = ['author', 'categories', 'featured_media'];

    /**
     * Create query builder
     *
     * @return \Therour\WpApiClient\Query\Builder
     */
    protected function newQuery()
    {
        $builder = parent::newQuery();
        $builder->relations = [
            'categories' => WpCategory::class,
            'featured_media' => WpMedia::class
        ];
        return $builder;
    }
}
