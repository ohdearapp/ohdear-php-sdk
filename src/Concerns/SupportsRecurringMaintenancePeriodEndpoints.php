<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\RecurringMaintenancePeriod;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\CreateRecurringMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\DeleteRecurringMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\GetRecurringMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\GetRecurringMaintenancePeriodsRequest;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\UpdateRecurringMaintenancePeriodRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsRecurringMaintenancePeriodEndpoints
{
    public function recurringMaintenancePeriods(int $monitorId): array
    {
        $request = new GetRecurringMaintenancePeriodsRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }

    public function recurringMaintenancePeriod(int $recurringMaintenancePeriodId): RecurringMaintenancePeriod
    {
        $request = new GetRecurringMaintenancePeriodRequest($recurringMaintenancePeriodId);

        return $this->send($request)->dto();
    }

    public function createRecurringMaintenancePeriod(array $data): RecurringMaintenancePeriod
    {
        $request = new CreateRecurringMaintenancePeriodRequest($data);

        return $this->send($request)->dto();
    }

    public function updateRecurringMaintenancePeriod(int $id, array $data): RecurringMaintenancePeriod
    {
        $request = new UpdateRecurringMaintenancePeriodRequest($id, $data);

        return $this->send($request)->dto();
    }

    public function deleteRecurringMaintenancePeriod(int $id): self
    {
        $request = new DeleteRecurringMaintenancePeriodRequest($id);

        $this->send($request);

        return $this;
    }
}
