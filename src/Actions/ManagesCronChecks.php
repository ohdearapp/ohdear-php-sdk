<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\CronCheck;

trait ManagesCronChecks
{
    public function cronChecks(int $monitorId)
    {
        return $this->transformCollection(
            $this->get("monitors/{$monitorId}/cron-checks")['data'],
            CronCheck::class
        );
    }

    public function createSimpleCronCheck(
        int $monitorId,
        string $name,
        int $frequencyInMinutes,
        int $graceTimeInMinutes,
        $description
    ): CronCheck {
        $attributes = $this->post("monitors/{$monitorId}/cron-checks", [
            'name' => $name,
            'type' => 'simple',
            'frequency_in_minutes' => $frequencyInMinutes,
            'grace_time_in_minutes' => $graceTimeInMinutes,
            'description' => $description ?? '',
        ]);

        return new CronCheck($attributes, $this);
    }

    public function createCronCheck(
        int $monitorId,
        string $name,
        string $cronExpression,
        int $graceTimeInMinutes,
        $description,
        string $serverTimezone
    ): CronCheck {
        $attributes = $this->post("monitors/{$monitorId}/cron-checks", [
            'name' => $name,
            'type' => 'cron',
            'cron_expression' => $cronExpression,
            'grace_time_in_minutes' => $graceTimeInMinutes,
            'description' => $description ?? '',
            'server_timezone' => $serverTimezone,
        ]);

        return new CronCheck($attributes, $this);
    }

    public function updateCronCheck(int $cronCheckId, array $payload): CronCheck
    {
        $attributes = $this->put("cron-checks/{$cronCheckId}", $payload);

        return new CronCheck($attributes, $this);
    }

    public function deleteCronCheck(int $cronCheckId): void
    {
        $this->delete("cron-checks/{$cronCheckId}");
    }

    public function syncCronChecks(int $monitorId, array $cronCheckAttributes): array
    {
        $response = $this->post("monitors/{$monitorId}/cron-checks/sync", ['cron_checks' => $cronCheckAttributes]);

        return $this->transformCollection(
            $response,
            CronCheck::class,
        );
    }
}
