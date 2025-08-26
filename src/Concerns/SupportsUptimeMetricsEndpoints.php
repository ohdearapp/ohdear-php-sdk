<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\UptimeMetric\HttpUptimeMetric;
use OhDear\PhpSdk\Dto\UptimeMetric\PingUptimeMetric;
use OhDear\PhpSdk\Dto\UptimeMetric\TcpUptimeMetric;
use OhDear\PhpSdk\Enums\UptimeMetricsSplit;
use OhDear\PhpSdk\Requests\UptimeMetrics\GetHttpUptimeMetricsRequest;
use OhDear\PhpSdk\Requests\UptimeMetrics\GetPingUptimeMetricsRequest;
use OhDear\PhpSdk\Requests\UptimeMetrics\GetTcpUptimeMetricsRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsUptimeMetricsEndpoints
{
    /** @return array<int, HttpUptimeMetric> */
    public function httpUptimeMetrics(int $monitorId, string $startDate, string $endDate, UptimeMetricsSplit $splitBy = UptimeMetricsSplit::Minute): array
    {
        $request = new GetHttpUptimeMetricsRequest($monitorId, $startDate, $endDate, $splitBy);

        return $this->send($request)->dtoOrFail();
    }

    /** @return array<int, PingUptimeMetric> */
    public function pingUptimeMetrics(int $monitorId, string $startDate, string $endDate, UptimeMetricsSplit $splitBy = UptimeMetricsSplit::Minute): array
    {
        $request = new GetPingUptimeMetricsRequest($monitorId, $startDate, $endDate, $splitBy);

        return $this->send($request)->dtoOrFail();
    }

    /** @return array<int, TcpUptimeMetric> */
    public function tcpUptimeMetrics(int $monitorId, string $startDate, string $endDate, UptimeMetricsSplit $splitBy = UptimeMetricsSplit::Minute): array
    {
        $request = new GetTcpUptimeMetricsRequest($monitorId, $startDate, $endDate, $splitBy);

        return $this->send($request)->dtoOrFail();
    }
}
