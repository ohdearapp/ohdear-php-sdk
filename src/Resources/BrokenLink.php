<?php

namespace OhDear\PhpSdk\Resources;

class BrokenLink extends ApiResource
{
    /*
     * The status code the site responded with.
     */
    public ?int $statusCode;

    /*
     * The url that is broken.
     */
    public string $crawledUrl;

    /*
     * The relative url that is broken.
     */
    public string $relativeCrawledUrl;

    /*
     * The url where the broken url was found.
     */
    public string $foundOnUrl;

    /*
     * The relative url where the broken url was found.
     */
    public string $relativeFoundOnUrl;

    /*
     * The text for the broken link.
     */
    public string $linkText;

    /*
     * Whether the broken link is internal.
     */
    public bool $internal;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
