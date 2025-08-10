<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Requests\ApplicationHealthChecks\GetApplicationHealthCheckHistoryRequest;
use OhDear\PhpSdk\Requests\ApplicationHealthChecks\GetApplicationHealthChecksRequest;

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
}