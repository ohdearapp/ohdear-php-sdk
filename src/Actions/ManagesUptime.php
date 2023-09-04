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
    public function uptime(int $siteId, string $startedAt, string $endedAt, string $split = 'month'): array
    {
        $sites = $this->get("sites/$siteId/uptime?filter[started_at]={$startedAt}&filter[ended_at]={$endedAt}&split={$split}");

        if (empty($sites)) {
            $sites = [];
        }

        return $this->transformCollection(
            $sites,
            Uptime::class
        );
    }
}
