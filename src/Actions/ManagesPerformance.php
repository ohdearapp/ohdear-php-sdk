<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\PerformanceRecord;

trait ManagesPerformance
{
    /**
     * @param int $siteId
     * @param string $start  Must be in format Ymdhis
     * @param string $end  Must be in format Ymdhis
     * @param string $timeframe  Should be 1m or 1h
     *
     * @return array
     */
    public function performanceRecords(int $siteId, string $start, string $end, string $timeframe = '1m'): array
    {
        return $this->transformCollection(
            $this->get("sites/$siteId/performance-records?filter[start]={$start}&filter[end]={$end}&filter[timeframe]={$timeframe}"),
            PerformanceRecord::class
        );
    }
}
