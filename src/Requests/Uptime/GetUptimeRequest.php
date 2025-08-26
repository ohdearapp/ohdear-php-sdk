<?php

namespace OhDear\PhpSdk\Requests\Uptime;

use OhDear\PhpSdk\Dto\Uptime;
use OhDear\PhpSdk\Helpers\Helpers;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetUptimeRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected string $startedAt,
        protected string $endedAt,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/uptime";
    }

    protected function defaultQuery(): array
    {
        return [
            'filter' => [
                'started_at' => Helpers::convertDateFormat($this->startedAt),
                'ended_at' => Helpers::convertDateFormat($this->endedAt),
            ],
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Uptime::collect($response);
    }
}
