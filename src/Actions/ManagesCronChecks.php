<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\CronCheck;

trait ManagesCronChecks
{
    public function cronChecks(int $siteId)
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/cron-checks")['data'],
            CronCheck::class
        );
    }

    public function createSimpleCronCheck(
        int $siteId,
        string $name,
        int $frequencyInMinutes,
        int $graceTimeInMinutes,
        string $description
    ): CronCheck {
        $attributes = $this->post("sites/{$siteId}/cron-checks", [
           'name' => $name,
           'type' => 'simple',
           'frequency_in_minutes' => $frequencyInMinutes,
           'grace_time_in_minutes' => $graceTimeInMinutes,
           'description' => $description,
        ]);

        return new CronCheck($attributes, $this);
    }

    public function createCronCheck(
        int $siteId,
        string $name,
        string $cronExpression,
        int $graceTimeInMinutes,
        string $description,
        string $serverTimezone
    ): CronCheck {
        $attributes = $this->post("sites/{$siteId}/cron-checks", [
            'name' => $name,
            'type' => 'cron',
            'cron_expression' => $cronExpression,
            'grace_time_in_minutes' => $graceTimeInMinutes,
            'description' => $description,
            'server_timezone' => $serverTimezone,
        ]);

        return new CronCheck($attributes, $this);
    }

    public function updateCronCheck(string $cronCheckId, array $payload): CronCheck
    {
        $attributes = $this->put("cron-checks/{$cronCheckId}", $payload);

        return new CronCheck($attributes, $this);
    }

    public function deleteCronCheck(int $cronCheckId): void
    {
        $this->delete("cron-checks/{$cronCheckId}");
    }

    public function syncCronChecks(int $siteId, array $cronCheckAttributes): void
    {
        $this->post("sites/{$siteId}/cron-checks/syncs", $cronCheckAttributes);
    }
}
