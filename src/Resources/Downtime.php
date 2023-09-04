<?php

namespace OhDear\PhpSdk\Resources;

class Downtime extends ApiResource
{
    public string $startedAt;

    public ?string $endedAt;
}
