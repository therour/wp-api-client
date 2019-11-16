<?php

namespace Therour\WpApiClient\Params;

class PageParam extends AbstractParam
{
    use Concerns\HasDate,
        Concerns\HasStatus,
        Concerns\HasAuthor;

    /**
     * Specify a resource name.
     *
     * @var string
     */
    protected $resourceName = 'pages';

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
     * Find by menu order.
     *
     * @var int
     */
    protected $menu_order;

    /**
     * Where has parent's page ids.
     *
     * @var array
     */
    protected $parent = [];

    /**
     * Exclude pages has page parent ids.
     *
     * @var array
     */
    protected $parent_exclude = [];

    public function whereParentIn(array $pageIds)
    {
        $this->parent = $pageIds;

        return $this;
    }

    public function whereParentNotIn(array $pageIds)
    {
        $this->parent_exclude = $pageIds;

        return $this;
    }
}
