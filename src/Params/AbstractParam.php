<?php

namespace Therour\WpApiClient\Params;

use Therour\WpApiClient\Contracts\ExecutableParam;
use Therour\WpApiClient\Exceptions\ParamException;
use Therour\WpApiClient\Exceptions\ParameterException;

abstract class AbstractParam implements ExecutableParam
{
    protected $id;

    /**
     * Specify a resource name.
     *
     * @var string
     */
    protected $resourceName;

    /**
     * forward where key to the value.
     *
     * @var array
     */
    protected $mapKeys = [];

    /**
     * Specify page of the collection.
     *
     * @var int
     */
    protected $page = 1;

    /**
     * Specify max number of items in the result set.
     *
     * @var int
     */
    protected $per_page = 10;

    /**
     * Search param..
     *
     * @var string
     */
    protected $search;

    /**
     * Exclude these ids.
     *
     * @var array
     */
    protected $exclude = [];

    /**
     * Where in ids
     *
     * @var array
     */
    protected $include = [];

    /**
     * Find by slug
     *
     * @var array|string
     */
    protected $slug;

    /**
     * Order type.
     *
     * @var string 'asc'|'desc'
     */
    protected $order = 'asc';

    /**
     * order by
     *
     * @var string
     */
    protected $orderby;

    /**
     * Initiate a param
     *
     * @param string $resourceName
     */
    public function __construct($resourceName = null)
    {
        if ($resourceName) {
            $this->resourceName = $resourceName;
        }

        if (is_null($this->resourceName)) {
            throw new ParamException("property \"resourceName\" must be specified");
        }
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
     * return all attributes.
     *
     * @return array
     */
    public function getParameters()
    {
        $attrs = get_object_vars($this);
        unset($attrs['resourceName']);
        return $attrs;
    }

    /**
     * get resource id.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set id.
     *
     * @param int $id
     * @return \Therour\WpApiClient\Params\AbstractParam
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function where($column, $equality = '=', $value = null)
    {
        $comparison = is_null($value) ? '=' : $equality;
        $value = is_null($value) ? $equality : $value;

        if (array_key_exists($column, $this->mapKeys)) {
            $column = $this->mapKeys[$column];
        }

        if ($comparison == '!=') {
            $column .= '_exclude';
        }

        if (! property_exists($this, $column)) {
            throw new ParameterException("parameter {$column} is not exits");
        }

        $this->$column = $value;

        return $this;
    }

    public function whereIn(array $ids)
    {
        $this->include = $ids;
        $this->per_page = count($ids);
        return $this;
    }

    public function whereNotIn(array $ids)
    {
        $this->exclude = $ids;

        return $this;
    }

    public function page(int $page)
    {
        $this->page = $page;

        return $this;
    }

    public function perPage(int $perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }

    public function orderBy($parameter, $order = 'asc')
    {
        $this->orderby = $parameter;
        $this->order = $order;

        return $this;
    }

    public function orderByDesc($parameter)
    {
        return $this->orderBy($parameter, 'desc');
    }
}
