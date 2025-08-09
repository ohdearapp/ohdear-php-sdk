<?php

namespace OhDear\PhpSdk\Requests\MaintenancePeriods;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class StopMaintenancePeriodsRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected int $monitorId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/stop-maintenance";
    }
}