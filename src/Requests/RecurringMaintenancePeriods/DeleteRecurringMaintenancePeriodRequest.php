<?php

namespace OhDear\PhpSdk\Requests\RecurringMaintenancePeriods;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteRecurringMaintenancePeriodRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $recurringMaintenancePeriodId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/recurring-maintenance-periods/{$this->recurringMaintenancePeriodId}";
    }
}
