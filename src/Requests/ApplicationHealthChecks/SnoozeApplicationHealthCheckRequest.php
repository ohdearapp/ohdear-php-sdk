<?php

namespace OhDear\PhpSdk\Requests\ApplicationHealthChecks;

use OhDear\PhpSdk\Dto\ApplicationHealthCheck;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class SnoozeApplicationHealthCheckRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int $monitorId,
        protected int $healthCheckId,
        protected int $minutes,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/application-health-checks/{$this->healthCheckId}/snooze";
    }

    protected function defaultBody(): array
    {
        return [
            'minutes' => $this->minutes,
        ];
    }

    public function createDtoFromResponse(Response $response): ApplicationHealthCheck
    {
        return ApplicationHealthCheck::fromResponse($response->json());
    }
}
