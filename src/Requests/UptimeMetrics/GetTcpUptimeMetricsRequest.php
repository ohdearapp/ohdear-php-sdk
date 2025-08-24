<?php

namespace OhDear\PhpSdk\Requests\UptimeMetrics;

use OhDear\PhpSdk\Dto\UptimeMetric\TcpUptimeMetric;
use OhDear\PhpSdk\Enums\UptimeMetricsSplit;
use OhDear\PhpSdk\Helpers\Helpers;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetTcpUptimeMetricsRequest extends Request
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
        return "/monitors/{$this->monitorId}/tcp-uptime-metrics";
    }

    protected function defaultQuery(): array
    {
        return [
            'filter[start]' => Helpers::convertDateFormat($this->startDate),
            'filter[end]' => Helpers::convertDateFormat($this->endDate),
            'filter[group_by]' => $this->splitBy->value,
        ];
    }

    /** @return array<int, TcpUptimeMetric> */
    public function createDtoFromResponse(Response $response): array
    {
        return TcpUptimeMetric::collect($response->json('data'));
    }
}
