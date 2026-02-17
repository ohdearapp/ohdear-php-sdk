<?php

namespace OhDear\PhpSdk\Requests\RecurringMaintenancePeriods;

use OhDear\PhpSdk\Dto\RecurringMaintenancePeriod;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateRecurringMaintenancePeriodRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/recurring-maintenance-periods';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): RecurringMaintenancePeriod
    {
        return RecurringMaintenancePeriod::fromResponse($response->json());
    }
}
