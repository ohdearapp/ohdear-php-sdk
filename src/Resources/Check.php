<?php

namespace OhDear\PhpSdk\Resources;

class Check extends ApiResource
{
    /**
     * The id of the site.
     *
     * @var int
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
        $updatedCheck = $this->ohDear->enableCheck($this->id);

        $this->enabled = $updatedCheck->enabled;
    }

    /**
     * Disable the check.
     */
    public function disable()
    {
        $updatedCheck = $this->ohDear->disableCheck($this->id);

        $this->enabled = $updatedCheck->enabled;
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
