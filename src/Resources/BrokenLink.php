<?php

namespace OhDear\PhpSdk\Resources;

class BrokenLink extends ApiResource
{
    /*
     * The status code the site responded with.
     */
    public int|null $statusCode;

    /*
     * The url that is broken.
     */
    public string $crawledUrl;

    /*
     * The url where the broken url was found.
     */
    public string $foundOnUrl;

    /*
     * The text for the broken link.
     */
    public string $linkText;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
