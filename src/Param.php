<?php

namespace Therour\WpApiClient;

class Param
{
    /**
     * Resource name
     *
     * @var string
     */
    protected $resourceName;

    /**
     * get identifier.
     *
     * @var int
     */
    protected $id;

    /**
     * specify page number.
     *
     * @var int
     */
    protected $page;

    /**
     * specify number of posts per page.
     *
     * @var int
     */
    protected $per_page;

    /**
     * specify search string.
     *
     * @var string
     */
    protected $search;

    /**
     * date published before specified
     *
     * @var \DateTime
     */
    protected $before;

    /**
     * date published after specified
     *
     * @var \DateTime
     */
    protected $after;

    /**
     * specify posts by author id.
     *
     * @var int|array
     */
    protected $author = [];

    /**
     * specify posts by author id.
     *
     * @var int|array
     */
    protected $excludeAuthor = [];

    /**
     * order sort attribute.
     *
     * @var string
     */
    protected $order = 'desc';

    /**
     * sort collection
     *
     * @var string
     */
    protected $orderBy;

    /**
     * query by slug.
     *
     * @var string|array
     */
    protected $slug;

    /**
     * query by categories.
     *
     * @var int|array
     */
    protected $categories = [];

    /**
     * exclude query by categories.
     *
     * @var int|array
     */
    protected $excludeCategories = [];

    /**
     * query by tags.
     *
     * @var int|array
     */
    protected $tags = [];

    /**
     * exclude query by tags.
     *
     * @var int|array
     */
    protected $excludeTags = [];

    /**
     * Initiate a param
     *
     * @param string $resourceName
     */
    public function __construct($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    /**
     * get a resource name.
     *
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * Get specify page number.
     *
     * @return  int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set specify page number.
     *
     * @param  int  $page  specify page number.
     *
     * @return  self
     */
    public function setPage(int $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get specify number of posts per page.
     *
     * @return  int
     */
    public function getPerPage()
    {
        return $this->per_page;
    }

    /**
     * Set specify number of posts per page.
     *
     * @param  int  $per_page  specify number of posts per page.
     *
     * @return  self
     */
    public function setPerPage(int $per_page)
    {
        $this->per_page = $per_page;

        return $this;
    }

    /**
     * Get date published before specified
     *
     * @return  \DateTime
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * Set date published before specified
     *
     * @param  \DateTime  $before  date published before specified
     *
     * @return  self
     */
    public function setBefore(\DateTime $before)
    {
        $this->before = $before;

        return $this;
    }

    /**
     * Get specify search string.
     *
     * @return  string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set specify search string.
     *
     * @param  string  $search  specify search string.
     *
     * @return  self
     */
    public function setSearch(string $search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get date published after specified
     *
     * @return  \DateTime
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * Set date published after specified
     *
     * @param  \DateTime  $after  date published after specified
     *
     * @return  self
     */
    public function setAfter(\DateTime $after)
    {
        $this->after = $after;

        return $this;
    }

    /**
     * Get specify posts by author id.
     *
     * @return  int|array
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set specify posts by author id.
     *
     * @param  int|array  $author  specify posts by author id.
     *
     * @return  self
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get specify posts by author id.
     *
     * @return  int|array
     */
    public function getExcludeAuthor()
    {
        return $this->excludeAuthor;
    }

    /**
     * Set specify posts by author id.
     *
     * @param  int|array  $excludeAuthor  specify posts by author id.
     *
     * @return  self
     */
    public function setExcludeAuthor($excludeAuthor)
    {
        $this->excludeAuthor = $excludeAuthor;

        return $this;
    }

    /**
     * Get order sort attribute.
     *
     * @return  string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set order sort attribute.
     *
     * @param  string  $order  order sort attribute.
     *
     * @return  self
     */
    public function setOrder(string $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get sort collection
     *
     * @return  string
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set sort collection
     *
     * @param  string  $orderBy  sort collection
     *
     * @return  self
     */
    public function setOrderBy(string $orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get query by slug.
     *
     * @return  string|array
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set query by slug.
     *
     * @param  string|array  $slug  query by slug.
     *
     * @return  self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get query by categories.
     *
     * @return  int|array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set query by categories.
     *
     * @param  int|array  $categories  query by categories.
     *
     * @return  self
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get exclude query by categories.
     *
     * @return  int|array
     */
    public function getExcludeCategories()
    {
        return $this->excludeCategories;
    }

    /**
     * Set exclude query by categories.
     *
     * @param  int|array  $excludeCategories  exclude query by categories.
     *
     * @return  self
     */
    public function setExcludeCategories($excludeCategories)
    {
        $this->excludeCategories = $excludeCategories;

        return $this;
    }

    /**
     * Get query by tags.
     *
     * @return  int|array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set query by tags.
     *
     * @param  int|array  $tags  query by tags.
     *
     * @return  self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get exclude query by tags.
     *
     * @return  int|array
     */
    public function getExcludeTags()
    {
        return $this->excludeTags;
    }

    /**
     * Set exclude query by tags.
     *
     * @param  int|array  $excludeTags  exclude query by tags.
     *
     * @return  self
     */
    public function setExcludeTags($excludeTags)
    {
        $this->excludeTags = $excludeTags;

        return $this;
    }

    /**
     * Get get identifier.
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set get identifier.
     *
     * @param  int  $id  get identifier.
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * return all attributes.
     *
     * @return array
     */
    public function getAll()
    {
        $attrs = get_object_vars($this);
        unset($attrs['resourceName']);
        return $attrs;
    }
}
