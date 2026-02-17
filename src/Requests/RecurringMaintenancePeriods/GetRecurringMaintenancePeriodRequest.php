<?php

namespace OhDear\PhpSdk\Requests\RecurringMaintenancePeriods;

use OhDear\PhpSdk\Dto\RecurringMaintenancePeriod;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetRecurringMaintenancePeriodRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $recurringMaintenancePeriodId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/recurring-maintenance-periods/{$this->recurringMaintenancePeriodId}";
    }

    public function createDtoFromResponse(Response $response): RecurringMaintenancePeriod
    {
        return RecurringMaintenancePeriod::fromResponse($response->json());
    }
}
