<?php

namespace OhDear\PhpSdk\Resources;

class ApplicationHealthCheck extends ApiResource
{
    public int $id;

    public string $name;

    public string $label;

    public string $status;

    public string $message;

    public string $shortSummary;

    public array $meta;

    public array $results = [];

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
