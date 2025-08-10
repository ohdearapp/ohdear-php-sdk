<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\LighthouseReport;
use OhDear\PhpSdk\Requests\LighthouseReports\GetLatestLighthouseReportRequest;
use OhDear\PhpSdk\Requests\LighthouseReports\GetLighthouseReportRequest;
use OhDear\PhpSdk\Requests\LighthouseReports\GetLighthouseReportsRequest;

trait SupportsLighthouseReportsEndpoints
{
    public function lighthouseReports(int $monitorId): array
    {
        $request = new GetLighthouseReportsRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }

    public function lighthouseReport(int $monitorId, int $lighthouseReportId): LighthouseReport
    {
        $request = new GetLighthouseReportRequest($monitorId, $lighthouseReportId);

        return $this->send($request)->dtoOrFail();
    }

    public function latestLighthouseReport(int $monitorId): LighthouseReport
    {
        $request = new GetLatestLighthouseReportRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }
}