<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\LighthouseReport;

trait ManagesLighthouseReports
{
    /**
     * @return array<LighthouseReport>
     */
    public function lighthouseReports(int $monitorId): array
    {
        return $this->transformCollection(
            $this->get("monitors/{$monitorId}/lighthouse-reports")['data'],
            LighthouseReport::class
        );
    }

    public function lighthouseReport(int $monitorId, int $reportId): LighthouseReport
    {
        $lighthouseReport = $this->get("monitors/{$monitorId}/lighthouse-reports/{$reportId}");

        return new LighthouseReport($lighthouseReport, $this);
    }

    public function latestLighthouseReport(int $monitorId): LighthouseReport
    {
        $lighthouseReport = $this->get("monitors/{$monitorId}/lighthouse-reports/latest");

        return new LighthouseReport($lighthouseReport, $this);
    }
}
