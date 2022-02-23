<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\ApplicationHealthCheck;
use OhDear\PhpSdk\Resources\ApplicationHealthCheckResult;

trait ManagesApplicationHealthChecks
{
    public function applicationHealthChecks(int $siteId): array
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/application-health-checks")['data'],
            ApplicationHealthCheck::class
        );
    }

    public function applicationHealthCheckResults(int $siteId, int $applicationHealthCheckId): array
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/application-health-checks/{$applicationHealthCheckId}")['data'],
            ApplicationHealthCheckResult::class
        );
    }
}
