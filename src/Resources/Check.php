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
     * The type of the check.
     *
     * @var string
     */
    public $type;

    /**
     * The human readable version of type.
     *
     * @var string
     */
    public $label;

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
        $this->ohDear->requestRun($this->id);
    }

    /**
     * Snooze this check.
     *
     * @return void
     */
    public function snooze(int $minutes)
    {
        $this->ohDear->snooze($this->id, $minutes);
    }

    /**
     * Unsnooze this check.
     *
     * @return void
     */
    public function unsnooze()
    {
        $this->ohDear->unsnooze($this->id);
    }
}
