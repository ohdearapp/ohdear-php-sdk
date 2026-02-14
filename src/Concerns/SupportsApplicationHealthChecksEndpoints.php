<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\ApplicationHealthCheck;
use OhDear\PhpSdk\Requests\ApplicationHealthChecks\GetApplicationHealthCheckHistoryRequest;
use OhDear\PhpSdk\Requests\ApplicationHealthChecks\GetApplicationHealthChecksRequest;
use OhDear\PhpSdk\Requests\ApplicationHealthChecks\SnoozeApplicationHealthCheckRequest;
use OhDear\PhpSdk\Requests\ApplicationHealthChecks\UnsnoozeApplicationHealthCheckRequest;

trait SupportsApplicationHealthChecksEndpoints
{
    public function applicationHealthChecks(int $monitorId): array
    {
        $request = new GetApplicationHealthChecksRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }

    public function applicationHealthCheckHistory(int $monitorId, int $applicationHealthCheckId): array
    {
        $request = new GetApplicationHealthCheckHistoryRequest($monitorId, $applicationHealthCheckId);

        return $this->send($request)->dtoOrFail();
    }

    public function snoozeApplicationHealthCheck(int $monitorId, int $healthCheckId, int $minutes): ApplicationHealthCheck
    {
        $request = new SnoozeApplicationHealthCheckRequest($monitorId, $healthCheckId, $minutes);

        return $this->send($request)->dto();
    }

    public function unsnoozeApplicationHealthCheck(int $monitorId, int $healthCheckId): ApplicationHealthCheck
    {
        $request = new UnsnoozeApplicationHealthCheckRequest($monitorId, $healthCheckId);

        return $this->send($request)->dto();
    }
}
