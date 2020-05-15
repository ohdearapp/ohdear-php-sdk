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
     * @param int|null $stopMaintenanceAfterSeconds
     *
     * @return MaintenancePeriod
     */
    public function startMaintenancePeriod(int $siteId, int $stopMaintenanceAfterSeconds = null): MaintenancePeriod
    {
        $payload = !$stopMaintenanceAfterSeconds ? [] : [
            'stop_maintenance_after_seconds' => $stopMaintenanceAfterSeconds
        ];

        $attributes = $this->post("sites/{$siteId}/start-maintenance", $payload);

        return new MaintenancePeriod($attributes, $this);
    }

    /**
     * @param int $siteId
     *
     * @return MaintenancePeriod
     */
    public function stopMaintenancePeriod(int $siteId): MaintenancePeriod
    {
        $attributes = $this->post("sites/{$siteId}/start-maintenance");

        return new MaintenancePeriod($attributes, $this);
    }

    /**
     * @param int $siteId
     * @param string $startsAt - Y:m:d H:i
     * @param string $endsAt - Y:m:d H:i
     *
     * @return MaintenancePeriod
     */
    public function createMaintenancePeriod(int $siteId, string $startsAt, string $endsAt): MaintenancePeriod
    {
        $payload = [
            'site_id' => $siteId,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt
        ];

        $attributes = $this->post('maintenance-periods', $payload);

        return new MaintenancePeriod($attributes, $this);
    }

    /**
     * @param int $maintenancePeriodId
     */
    public function deleteMaintenancePeriod(int $maintenancePeriodId)
    {
        $this->delete("maintenance-periods/{$maintenancePeriodId}");
    }
}
