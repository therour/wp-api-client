<?php

namespace Therour\WpApiClient\Params;

class TagParam extends AbstractParam
{
    /**
     * Specify a resource name.
     *
     * @var string
     */
    protected $resourceName = 'tags';

    /**
     * Hide empty count.
     *
     * @var bool
     */
    protected $hide_empty = false;

    /**
     * Where assigned to post id.
     *
     * @var int
     */
    protected $post;

    /**
     * Order type.
     *
     * @var string asc|desc
     */
    protected $order = 'asc';

    /**
     * order by
     *
     * @var string id|include|name|slug|include_slugs|term_group|description|count
     */
    protected $orderby = 'name';
}
