<?php

namespace OhDear\PhpSdk\Resources;

class SitemapIssue extends ApiResource
{
    public string $name;

    public ?string $url;

    public ?int $responseCode;

    public function __construct(mixed $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
