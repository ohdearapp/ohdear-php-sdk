<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\MaintenancePeriod;
use OhDear\PhpSdk\Requests\MaintenancePeriods\CreateMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\DeleteMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\GetMaintenancePeriodsRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\StartMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\StopMaintenancePeriodsRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\UpdateMaintenancePeriodRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsMaintenancePeriodEndpoints
{
    /** @return iterable<int, MaintenancePeriod> */
    public function maintenancePeriods(int $monitorId, ?string $startedAt = null, ?string $endedAt = null): iterable
    {
        $request = new GetMaintenancePeriodsRequest($monitorId, $startedAt, $endedAt);

        /** @var iterable<int, MaintenancePeriod> $items */
        $items = $this->paginate($request)->items();
        
        return $items;
    }

    public function startMaintenancePeriod(int $monitorId, ?int $stopMaintenanceAfterSeconds = null, ?string $name = null): MaintenancePeriod
    {
        $request = new StartMaintenancePeriodRequest($monitorId, $stopMaintenanceAfterSeconds, $name);

        return $this->send($request)->dto();
    }

    public function stopMaintenancePeriod(int $monitorId): self
    {
        $request = new StopMaintenancePeriodsRequest($monitorId);

        $this->send($request);

        return $this;
    }

    public function createMaintenancePeriod(array $maintenancePeriodData): MaintenancePeriod
    {
        $request = new CreateMaintenancePeriodRequest($maintenancePeriodData);

        return $this->send($request)->dto();
    }

    public function updateMaintenancePeriod(int $maintenancePeriodId, array $maintenancePeriodData): MaintenancePeriod
    {
        $request = new UpdateMaintenancePeriodRequest($maintenancePeriodId, $maintenancePeriodData);

        return $this->send($request)->dto();
    }

    public function deleteMaintenancePeriod(int $maintenancePeriodId): self
    {
        $request = new DeleteMaintenancePeriodRequest($maintenancePeriodId);

        $this->send($request);

        return $this;
    }
}
