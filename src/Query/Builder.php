<?php

namespace Therour\WpApiClient\Query;

use BadMethodCallException;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Therour\WpApiClient\Models\WpModel;
use Illuminate\Support\Traits\ForwardsCalls;

class Builder
{
    use Concerns\BuildParams,
        Concerns\BuildExecutor,
        ForwardsCalls;

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

    public $relations = [];

    /**
     * execute query and collect the data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function get()
    {
        $json = $this->execute($this->param());
        $collection =  collect(json_decode($json))->map(function ($data) {
            return $this->newModelInstance((array) $data);
        });
        foreach ($this->relations as $key => $class) {
            $relatedIds = $collection->map->$key->flatten()->unique()->values();
            if ($relatedIds->isEmpty()) {
                $collection->map(function ($model) use ($key) {
                    $model->setAttribute($key, is_array($model->$key) ? [] : null);
                    return $model;
                });
            } else {
                $relatedClasses = (new $class)->whereIn($relatedIds->all())->get()->keyBy->id;
                $collection->map(function ($model) use ($key, $relatedClasses) {
                    if (is_array($model->$key)) {
                        $model->setAttribute($key, $relatedClasses->only($model->$key)->values());
                    } else {
                        $model->setAttribute($key, $relatedClasses[$model->$key] ?? null);
                    }
                    return $model;
                });
            }
        }
        return $collection;
    }

    public function first()
    {
        return $this->get()->first();
    }

    public function paginate($perPage = 10, $page = null, $pageName = 'page')
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $this->page($page)->perPage($perPage);

        $items = $this->get();
        return $this->simplePaginator($items, $perPage, $page, [
            'path' => url()->current(),
            'pageName' => 'page',
        ])->hasMorePagesWhen($items->count() == $perPage);
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
        return app()->makeWith(Paginator::class, compact(
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

    public function __call($name, $arguments)
    {
        try {
            $this->forwardCallTo($this->param(), $name, $arguments);
            return $this;
        } catch (BadMethodCallException $ex) {
            $className = get_class($this);
            throw new BadMethodCallException("Method {$className}::{$name} does not exists");
        }
    }
}
