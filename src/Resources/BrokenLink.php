<?php

namespace OhDear\PhpSdk\Resources;

class BrokenLink extends ApiResource
{
    /**
     * The status code the site responded with.
     *
     * @var int|null
     */
    public $statusCode;

    /**
     * The url that is broken.
     *
     * @var string
     */
    public $crawledUrl;

    /**
     * The url where the broken url was found.
     *
     * @var string
     */
    public $foundOnUrl;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
