<?php

namespace OhDear\PhpSdk\Requests\RecurringMaintenancePeriods;

use OhDear\PhpSdk\Dto\RecurringMaintenancePeriod;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetRecurringMaintenancePeriodsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/recurring-maintenance-periods";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return RecurringMaintenancePeriod::collect($response->json('data'));
    }
}
