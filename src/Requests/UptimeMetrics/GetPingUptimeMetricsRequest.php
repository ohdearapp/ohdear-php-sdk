<?php

namespace OhDear\PhpSdk\Requests\UptimeMetrics;

use OhDear\PhpSdk\Dto\UptimeMetric\PingUptimeMetric;
use OhDear\PhpSdk\Enums\UptimeMetricsSplit;
use OhDear\PhpSdk\Helpers\Helpers;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetPingUptimeMetricsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected string $startDate,
        protected string $endDate,
        protected UptimeMetricsSplit $splitBy = UptimeMetricsSplit::Minute
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/ping-uptime-metrics";
    }

    protected function defaultQuery(): array
    {
        return [
            'filter[start]' => Helpers::convertDateFormat($this->startDate),
            'filter[end]' => Helpers::convertDateFormat($this->endDate),
            'filter[group_by]' => $this->splitBy->value,
        ];
    }

    /** @return array<int, PingUptimeMetric> */
    public function createDtoFromResponse(Response $response): array
    {
        return PingUptimeMetric::collect($response->json('data'));
    }
}
