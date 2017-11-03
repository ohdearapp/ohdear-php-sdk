<?php

namespace OhDear\PhpSdk\Resources;

class Check extends Resource
{
    /**
     * The id of the site.
     *
     * @var integer
     */
    public $id;

    /**
     * The url of the site.
     *
     * @var string
     */
    public $type;

    /**
     * Is the check enabled?
     *
     * @var bool
     */
    public $enabled;

    /**
     * Enable the check.
     */
    public function enable()
    {

    }

    /**
     * Disable the check.
     */
    public function disable()
    {

    }

    /**
     * Request a new run.
     *
     * @return void
     */
    public function requestRun()
    {

    }
}

