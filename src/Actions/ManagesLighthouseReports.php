<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\LighthouseReport;

trait ManagesLighthouseReports
{
    /**
     * @return array<LighthouseReport>
     */
    public function lighthouseReports(int $siteId): array
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/lighthouse-reports")['data'],
            LighthouseReport::class
        );
    }

    public function lighthouseReport(int $siteId, int $reportId): LighthouseReport
    {
        $lighthouseReport = $this->get("sites/{$siteId}/lighthouse-reports/{$reportId}");

        return new LighthouseReport($lighthouseReport, $this);
    }

    public function latestLighthouseReport(int $siteId): LighthouseReport
    {
        $lighthouseReport = $this->get("sites/{$siteId}/lighthouse-reports/latest");

        return new LighthouseReport($lighthouseReport, $this);
    }
}
