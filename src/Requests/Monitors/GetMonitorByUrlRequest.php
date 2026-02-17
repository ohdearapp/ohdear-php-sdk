<?php

namespace OhDear\PhpSdk\Requests\Monitors;

use OhDear\PhpSdk\Dto\Monitor;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetMonitorByUrlRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $monitorUrl
    ) {}

    public function resolveEndpoint(): string
    {
        return '/monitors/url/'.urlencode($this->monitorUrl);
    }

    public function createDtoFromResponse(Response $response): Monitor
    {
        return Monitor::fromResponse($response->json());
    }
}
