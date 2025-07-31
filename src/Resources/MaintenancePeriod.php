<?php

namespace OhDear\PhpSdk\Resources;

class MaintenancePeriod extends ApiResource
{
    public int $id;

    public int $monitorId;

    public string $startsAt;

    public ?string $endsAt;
}
