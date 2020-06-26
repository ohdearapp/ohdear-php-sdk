<?php

namespace OhDear\PhpSdk\Resources;

class CronCheck extends ApiResource
{
    /**
     * The id of the cron check.
     *
     * @var int
     */
    public $id;

    /**
     * The uuid of the cron check.
     *
     * @var int
     */
    public $uuid;

    /**
     * The check id of the cron check.
     *
     * @var string
     */
    public $checkId;

    /**
     * The check period in minutes.
     *
     * @var int
     */
    public $frequencyInMinutes;

    /**
     * The check period in minutes.
     *
     * @var int
     */
    public $graceTimeInMinutes;

    /**
     * The cron expression being used
     *
     * @var int
     */
    public $cronExpression;
}
