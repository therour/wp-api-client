<?php

namespace Therour\WpApiClient\Params\Concerns;

trait HasDate
{
    /**
     * Date format used in wordpress json.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d\TH:i:sP';

    /**
     * Where date published is after specified date.
     *
     * @var DateTime
     */
    protected $after;

    /**
     * Where date published is before specified date.
     *
     * @var DateTime
     */
    protected $before;
}
