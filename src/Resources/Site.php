<?php

namespace OhDear\PhpSdk\Resources;

class Site extends Resource
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
    public $url;

    /**
     * The sort url of the site.
     *
     * @var string
     */
    public $sortUrl;

    /**
     * Delete the given site.
     *
     * @return void
     */
    public function delete()
    {
        $this->ohDear->deleteSite($this->serverId, $this->id);
    }
}

