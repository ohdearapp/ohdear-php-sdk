<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Downtime;

trait ManagesDowntime
{
    /**
     * @param  string  $startedAt  Short (2020-12-01) or long (2020-12-01 15:00:00) date format
     * @param  string  $endedAt  Short (2020-12-01) or long (2020-12-01 15:00:00) date format
     */
    public function downtime(int $monitorId, string $startedAt, string $endedAt): array
    {
        $startedAt = $this->convertDateFormat($startedAt);
        $endedAt = $this->convertDateFormat($endedAt);

        return $this->transformCollection(
            $this->get("monitors/$monitorId/downtime?filter[started_at]={$startedAt}&filter[ended_at]={$endedAt}")['data'],
            Downtime::class
        );
    }
}
