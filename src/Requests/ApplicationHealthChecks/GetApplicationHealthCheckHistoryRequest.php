<?php

namespace OhDear\PhpSdk\Requests\ApplicationHealthChecks;

use OhDear\PhpSdk\Dto\ApplicationHealthCheckHistoryItem;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetApplicationHealthCheckHistoryRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected int $applicationHealthCheckId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/application-health-checks/{$this->applicationHealthCheckId}";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return ApplicationHealthCheckHistoryItem::collect($response);
    }
}
