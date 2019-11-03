<?php

namespace Therour\WpApiClient\Query;

use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Therour\WpApiClient\Models\WpModel;

class Builder
{
    use Concerns\BuildParams,
        Concerns\BuildExecutor;

    /**
     * resource name
     *
     * @var string
     */
    protected $resourceName;

    /**
     * Model instance.
     *
     * @var \Therour\WpApiClient\Models\WpModel
     */
    protected $model;

    public function __construct($resourceName)
    {
        $this->resourceName = Str::plural($resourceName);
    }

    public function find(int $id)
    {
        $param = $this->newParam();
        $param->setId($id);

        $json = $this->execute($param);
        return $this->newModelInstance(json_decode($json, true));
    }

    /**
     * execute query and collect the data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function get()
    {
        $json = $this->execute($this->param());
        return collect(json_decode($json))->map(function ($data) {
            return $this->newModelInstance((array) $data);
        });
    }

    public function first()
    {
        return $this->get()->first();
    }

    public function paginate($perPage = 10, $page = null, $pageName = 'page')
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $this->page($page)->perPage($perPage);

        return $this->simplePaginator($this->get(), $perPage, $page, []);
    }

    /**
     * Create a new simple paginator instance.
     *
     * @param  \Illuminate\Support\Collection  $items
     * @param  int $perPage
     * @param  int $currentPage
     * @param  array  $options
     * @return \Illuminate\Pagination\Paginator
     */
    protected function simplePaginator($items, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(Paginator::class, compact(
            'items',
            'perPage',
            'currentPage',
            'options'
        ));
    }

    public function setModel(WpModel $model)
    {
        $this->model = $model;
    }

    protected function newModelInstance($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }
}
