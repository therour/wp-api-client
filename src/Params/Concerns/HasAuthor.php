<?php

namespace Therour\WpApiClient\Params\Concerns;

trait HasAuthor
{
    /**
     * Where author in specified author ids.
     *
     * @var array
     */
    protected $author;

    /**
     * Where author not in specified author ids..
     *
     * @var array
     */
    protected $author_exclude;
}
