<?php

namespace OhDear\PhpSdk\Resources;

class MaintenancePeriod extends ApiResource
{
    public int $id;

    public int $siteId;

    public string $startsAt;

    public string|null $endsAt;
}
