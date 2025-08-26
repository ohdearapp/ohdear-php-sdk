<?php

namespace OhDear\PhpSdk\Requests\MaintenancePeriods;

use OhDear\PhpSdk\Dto\MaintenancePeriod;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateMaintenancePeriodRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $maintenancePeriodData
    ) {}

    public function resolveEndpoint(): string
    {
        return '/maintenance-periods';
    }

    protected function defaultBody(): array
    {
        return $this->maintenancePeriodData;
    }

    public function createDtoFromResponse(Response $response): MaintenancePeriod
    {
        return MaintenancePeriod::fromResponse($response->json());
    }
}
