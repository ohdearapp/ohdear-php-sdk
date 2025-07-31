<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Uptime;

trait ManagesUptime
{
    /**
     * @param  string  $startedAt  Must be in format Ymdhis
     * @param  string  $endedAt  Must be in format Ymdhis
     * @param  string  $split  Use hour, day or month
     */
    public function uptime(int $monitorId, string $startedAt, string $endedAt, string $split = 'month'): array
    {
        $monitors = $this->get("monitors/$monitorId/uptime?filter[started_at]={$startedAt}&filter[ended_at]={$endedAt}&split={$split}");

        if (empty($monitors)) {
            $monitors = [];
        }

        return $this->transformCollection(
            $monitors,
            Uptime::class
        );
    }
}
