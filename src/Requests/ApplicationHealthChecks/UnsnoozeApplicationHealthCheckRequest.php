<?php

namespace OhDear\PhpSdk\Requests\ApplicationHealthChecks;

use OhDear\PhpSdk\Dto\ApplicationHealthCheck;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class UnsnoozeApplicationHealthCheckRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected int $monitorId,
        protected int $healthCheckId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/application-health-checks/{$this->healthCheckId}/unsnooze";
    }

    public function createDtoFromResponse(Response $response): ApplicationHealthCheck
    {
        return ApplicationHealthCheck::fromResponse($response->json());
    }
}
