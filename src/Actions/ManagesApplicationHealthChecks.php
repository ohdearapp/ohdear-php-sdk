<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\ApplicationHealthCheck;
use OhDear\PhpSdk\Resources\ApplicationHealthCheckResult;

trait ManagesApplicationHealthChecks
{
    public function applicationHealthChecks(int $monitorId): array
    {
        return $this->transformCollection(
            $this->get("monitors/{$monitorId}/application-health-checks")['data'],
            ApplicationHealthCheck::class
        );
    }

    public function applicationHealthCheckResults(int $monitorId, int $applicationHealthCheckId): array
    {
        return $this->transformCollection(
            $this->get("monitors/{$monitorId}/application-health-checks/{$applicationHealthCheckId}")['data'],
            ApplicationHealthCheckResult::class
        );
    }
}
