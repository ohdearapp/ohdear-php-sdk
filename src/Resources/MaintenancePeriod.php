<?php

namespace OhDear\PhpSdk\Resources;

class MaintenancePeriod extends ApiResource
{
    /**
     * The id of the maintenance period.
     *
     * @var int
     */
    public $id;

    /**
     * The id of the site.
     *
     * @var int
     */
    public $siteId;

    /**
     * When the period will start.
     *
     * @var string
     */
    public $startsAt;

    /**
     * When the period will end.
     *
     * @var string
     */
    public $endsAt;
}
