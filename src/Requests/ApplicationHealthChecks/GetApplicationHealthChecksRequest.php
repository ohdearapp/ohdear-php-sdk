<?php

namespace OhDear\PhpSdk\Requests\ApplicationHealthChecks;

use OhDear\PhpSdk\Dto\ApplicationHealthCheck;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetApplicationHealthChecksRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/application-health-checks";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return ApplicationHealthCheck::collect($response);
    }
}