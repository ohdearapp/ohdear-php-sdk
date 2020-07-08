<?php

namespace OhDear\PhpSdk\Resources;

class Downtime extends ApiResource
{
    public string $startedAt;

    /** @var string */
    public ?string $endedAt;
}
