<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\MaintenancePeriod;

trait ManagesMaintenancePeriods
{
    public function maintenancePeriods(int $monitorId): array
    {
        return $this->transformCollection(
            $this->get("monitors/{$monitorId}/maintenance-periods")['data'],
            MaintenancePeriod::class
        );
    }

    /**
     * @param  int  $stopMaintenanceAfterSeconds  Stops after one hour by default
     */
    public function startMonitorMaintenance(int $monitorId, int $stopMaintenanceAfterSeconds = 60 * 60): MaintenancePeriod
    {
        $attributes = $this->post("monitors/{$monitorId}/start-maintenance", [
            'stop_maintenance_after_seconds' => $stopMaintenanceAfterSeconds,
        ]);

        return new MaintenancePeriod($attributes, $this);
    }

    public function stopMonitorMaintenance(int $monitorId)
    {
        $this->post("monitors/{$monitorId}/stop-maintenance");
    }

    /**
     * @param  string  $startsAt  Y-m-d H:i
     * @param  string  $endsAt  Y-m-d H:i
     */
    public function createSiteMaintenance(int $monitorId, string $startsAt, string $endsAt): MaintenancePeriod
    {
        $startsAt = $this->convertDateFormat($startsAt, 'Y-m-d H:i');
        $endsAt = $this->convertDateFormat($endsAt, 'Y-m-d H:i');

        $payload = [
            'site_id' => $monitorId,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ];

        $attributes = $this->post('maintenance-periods', $payload);

        return new MaintenancePeriod($attributes, $this);
    }

    public function deleteSiteMaintenance(int $maintenancePeriodId)
    {
        $this->delete("maintenance-periods/{$maintenancePeriodId}");
    }
}
