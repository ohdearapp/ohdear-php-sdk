<?php

namespace OhDear\PhpSdk\Requests\Monitors;

use OhDear\PhpSdk\Dto\Monitor;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetMonitorRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}";
    }

    public function createDtoFromResponse(Response $response): Monitor
    {
        return Monitor::fromResponse($response->json());
    }
}
