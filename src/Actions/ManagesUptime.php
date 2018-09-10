<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Uptime;

trait ManagesUptime
{
    /**
     * @param int $siteId
     * @param string $startedAt  Must be in format Ymdhis
     * @param string $endedAt  Must be in format Ymdhis
     * @param string $split  Use hour, day or month
     *
     * @return array
     */
    public function uptime(int $siteId, string $startedAt, string $endedAt, string $split = 'month'): array
    {
        return $this->transformCollection(
            $this->get("$siteId/uptime?filter[started_at={$startedAt}]&filter[ended_at={$endedAt}&split={$split}")['data'],
            Uptime::class
        );
    }
}