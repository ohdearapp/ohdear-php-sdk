<?php

namespace OhDear\PhpSdk\Resources;

class Site extends ApiResource
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
    public $url;

    /**
     * The checks of a site.
     *
     * @var Check[]
     */
    public $checks;

    /**
     * The sort url of the site.
     *
     * @var string
     */
    public $sortUrl;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);

        $this->checks = array_map(function (array $checkAttributes) {
            return new Check($checkAttributes);
        }, $this->checks);
    }

    /**
     * Delete the given site.
     *
     * @return void
     */
    public function delete()
    {
        $this->ohDear->deleteSite($this->id);
    }

    /**
     * Get the broken links for this site.
     *
     * @return array
     */
    public function brokenLinks()
    {
        return $this->ohDear->brokenLinks($this->id);
    }

    /**
     * Get the detected mixed content for a site.
     *
     * @return array
     */
    public function mixedContent()
    {
        return $this->ohDear->mixedContent($this->id);
    }

    /**
     * Get the uptime percentages for a site.
     *
     * @param string $startedAt  Must be in format Ymdhis
     * @param string $endedAt  Must be in format Ymdhis
     * @param string $split  Use hour, day or month
     *
     * @return array
     */
    public function uptime(string $startedAt, string $endedAt, string $split)
    {
        return $this->ohDear->uptime($this->id, $startedAt, $endedAt, $split);
    }

    /**
     * Get the downtime periods for a site.
     *
     * @param string $startedAt  Must be in format Ymdhis
     * @param string $endedAt  Must be in format Ymdhis
     *
     * @return array
     */
    public function downtime(string $startedAt, string $endedAt)
    {
        return $this->ohDear->downtime($this->id, $startedAt, $endedAt);
    }
}
