<?php

namespace Therour\WpApiClient\Params;

class PostParam extends AbstractParam
{
    use Concerns\HasDate,
        Concerns\HasStatus,
        Concerns\HasAuthor;

    /**
     * Specify a resource name.
     *
     * @var string
     */
    protected $resourceName = 'posts';

    /**
     * forward where key to the value.
     *
     * @var array
     */
    protected $mapKeys = [
        'category' => 'categories',
        'tag' => 'tags',
    ];

    /**
     * Order type.
     *
     * @var string asc|desc
     */
    protected $order = 'desc';

    /**
     * order by
     *
     * @var string author|date|id|include|modified|parent|relevance|slug|include_slugs|title
     */
    protected $orderby = 'date';

    /**
     * Where has category(s).
     *
     * @var int|array
     */
    protected $categories;

    /**
     * Where has not category(s).
     *
     * @var int|array
     */
    protected $categories_exclude;

    /**
     * Where has tag(s).
     *
     * @var int|array
     */
    protected $tags;

    /**
     * Where has not tag(s).
     *
     * @var int|array
     */
    protected $tags_exclude;

    /**
     * Where the post is sticky.
     *
     * @var bool
     */
    protected $sticky;
}
