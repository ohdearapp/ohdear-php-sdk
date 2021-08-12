<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\PerformanceRecord;

trait ManagesPerformance
{
    /**
     * @param int $siteId
     * @param string $start Short (2020-12-01) or long (2020-12-01 15:00:00) date format
     * @param string $end Short (2020-12-01) or long (2020-12-01 15:00:00) date format
     * @param string $timeframe Should be 1m or 1h
     * @param string $sort
     * @return array
     */
    public function performanceRecords(
        int $siteId,
        string $start,
        string $end,
        string $groupBy = 'minute',
        string $sort = '-created_at'
    ): array {
        $start = $this->convertDateFormat($start);
        $end = $this->convertDateFormat($end);

        if ($groupBy === '1m') {
            $groupBy = 'minute';
        }

        if ($groupBy === '1h') {
            $groupBy = 'hour';
        }

        return $this->transformCollection(
            $this->get("sites/$siteId/performance-records?filter[start]={$start}&filter[end]={$end}&filter[group_by]={$groupBy}&sort={$sort}")['data'],
            PerformanceRecord::class
        );
    }
}
