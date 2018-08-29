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
}
