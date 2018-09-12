<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Downtime;

trait ManagesDowntime
{
    /**
     * @param int $siteId
     * @param string $startedAt  Must be in format Ymdhis
     * @param string $endedAt  Must be in format Ymdhis
     *
     * @return array
     */
    public function downtime(int $siteId, string $startedAt, string $endedAt): array
    {
        return $this->transformCollection(
            $this->get("sites/$siteId/downtime?filter[started_at]={$startedAt}&filter[ended_at]={$endedAt}")['data'],
            Downtime::class
        );
    }
}
