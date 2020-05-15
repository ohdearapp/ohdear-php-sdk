<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\MaintenancePeriod;

trait ManagesMaintenancePeriods
{
    /**
     * @param int $siteId
     *
     * @return array
     */
    public function maintenancePeriods(int $siteId): array
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/maintenance-periods")['data'],
            MaintenancePeriod::class
        );
    }

    /**
     * @param int $siteId
     * @param int $stopMaintenanceAfterSeconds Stops after one hour by default
     *
     * @return MaintenancePeriod
     */
    public function startSiteMaintenance(int $siteId, int $stopMaintenanceAfterSeconds = 60 * 60): MaintenancePeriod
    {
        $attributes = $this->post("sites/{$siteId}/start-maintenance", [
            'stop_maintenance_after_seconds' => $stopMaintenanceAfterSeconds,
        ]);

        return new MaintenancePeriod($attributes, $this);
    }

    /**
     * @param int $siteId
     */
    public function stopSiteMaintenance(int $siteId)
    {
        $this->post("sites/{$siteId}/stop-maintenance");
    }

    /**
     * @param int $siteId
     * @param string $startsAt Y:m:d H:i
     * @param string $endsAt Y:m:d H:i
     *
     * @return MaintenancePeriod
     */
    public function createSiteMaintenance(int $siteId, string $startsAt, string $endsAt): MaintenancePeriod
    {
        $payload = [
            'site_id' => $siteId,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ];

        $attributes = $this->post('maintenance-periods', $payload);

        return new MaintenancePeriod($attributes, $this);
    }

    /**
     * @param int $maintenancePeriodId
     */
    public function deleteSiteMaintenance(int $maintenancePeriodId)
    {
        $this->delete("maintenance-periods/{$maintenancePeriodId}");
    }
}
