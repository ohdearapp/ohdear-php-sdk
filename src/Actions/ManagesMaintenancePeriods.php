<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\MaintenancePeriod;

trait ManagesMaintenancePeriods
{
    public function maintenancePeriods(int $siteId): array
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/maintenance-periods")['data'],
            MaintenancePeriod::class
        );
    }

    /**
     * @param  int  $stopMaintenanceAfterSeconds  Stops after one hour by default
     */
    public function startSiteMaintenance(int $siteId, int $stopMaintenanceAfterSeconds = 60 * 60): MaintenancePeriod
    {
        $attributes = $this->post("sites/{$siteId}/start-maintenance", [
            'stop_maintenance_after_seconds' => $stopMaintenanceAfterSeconds,
        ]);

        return new MaintenancePeriod($attributes, $this);
    }

    public function stopSiteMaintenance(int $siteId)
    {
        $this->post("sites/{$siteId}/stop-maintenance");
    }

    /**
     * @param  string  $startsAt  Y-m-d H:i
     * @param  string  $endsAt  Y-m-d H:i
     */
    public function createSiteMaintenance(int $siteId, string $startsAt, string $endsAt): MaintenancePeriod
    {
        $startsAt = $this->convertDateFormat($startsAt, 'Y-m-d H:i');
        $endsAt = $this->convertDateFormat($endsAt, 'Y-m-d H:i');

        $payload = [
            'site_id' => $siteId,
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
