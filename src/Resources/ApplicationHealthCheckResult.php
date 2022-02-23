<?php

namespace OhDear\PhpSdk\Resources;

class ApplicationHealthCheckResult extends ApiResource
{
    public int $id;

    public string $status;

    public string $message;

    public string $shortSummary;

    public array $meta;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
