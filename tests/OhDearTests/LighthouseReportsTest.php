<?php

use OhDear\PhpSdk\Requests\LighthouseReports\GetLatestLighthouseReportRequest;
use OhDear\PhpSdk\Requests\LighthouseReports\GetLighthouseReportRequest;
use OhDear\PhpSdk\Requests\LighthouseReports\GetLighthouseReportsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get lighthouse reports', function () {
    MockClient::global([
        GetLighthouseReportsRequest::class => MockResponse::fixture('lighthouse-reports'),
    ]);

    $lighthouseReports = $this->ohDear->lighthouseReports(82060);

    expect($lighthouseReports)->toBeArray();

    foreach ($lighthouseReports as $report) {
        expect($report->id)->toBeInt();
        expect($report->performanceScore)->toBeInt();
        expect($report->accessibilityScore)->toBeInt();
        expect($report->bestPracticesScore)->toBeInt();
        expect($report->seoScore)->toBeInt();
        expect($report->progressiveWebAppScore)->toBeInt();
        expect($report->firstContentfulPaintInMs)->toBeFloat();
        expect($report->speedIndexInMs)->toBeFloat();
        expect($report->largestContentfulPaintInMs)->toBeFloat();
        expect($report->timeToInteractiveInMs)->toBeFloat();
        expect($report->totalBlockingTimeInMs)->toBeFloat();
        expect($report->cumulativeLayoutShift)->toBeFloat();
        expect($report->performedOnCheckerServer)->toBeString();
        expect($report->createdAt)->toBeString();
    }
});

it('can get a single lighthouse report', function () {
    MockClient::global([
        GetLighthouseReportRequest::class => MockResponse::fixture('lighthouse-report'),
    ]);

    $report = $this->ohDear->lighthouseReport(82060, 2851696);

    expect($report->id)->toBeInt();
    expect($report->performanceScore)->toBeInt();
    expect($report->accessibilityScore)->toBeInt();
    expect($report->bestPracticesScore)->toBeInt();
    expect($report->seoScore)->toBeInt();
    expect($report->progressiveWebAppScore)->toBeInt();
    expect($report->firstContentfulPaintInMs)->toBeFloat();
    expect($report->speedIndexInMs)->toBeFloat();
    expect($report->largestContentfulPaintInMs)->toBeFloat();
    expect($report->timeToInteractiveInMs)->toBeFloat();
    expect($report->totalBlockingTimeInMs)->toBeFloat();
    expect($report->cumulativeLayoutShift)->toBeFloat();
    expect($report->performedOnCheckerServer)->toBeString();
    expect($report->jsonReport)->toBeArray();
    expect($report->createdAt)->toBeString();
});

it('can get the latest lighthouse report', function () {
    MockClient::global([
        GetLatestLighthouseReportRequest::class => MockResponse::fixture('latest-lighthouse-report'),
    ]);

    $latestReport = $this->ohDear->latestLighthouseReport(82060);

    expect($latestReport->id)->toBeInt();
    expect($latestReport->performanceScore)->toBeInt();
    expect($latestReport->accessibilityScore)->toBeInt();
    expect($latestReport->bestPracticesScore)->toBeInt();
    expect($latestReport->seoScore)->toBeInt();
    expect($latestReport->progressiveWebAppScore)->toBeInt();
    expect($latestReport->firstContentfulPaintInMs)->toBeFloat();
    expect($latestReport->speedIndexInMs)->toBeFloat();
    expect($latestReport->largestContentfulPaintInMs)->toBeFloat();
    expect($latestReport->timeToInteractiveInMs)->toBeFloat();
    expect($latestReport->totalBlockingTimeInMs)->toBeFloat();
    expect($latestReport->cumulativeLayoutShift)->toBeFloat();
    expect($latestReport->performedOnCheckerServer)->toBeString();
    expect($latestReport->jsonReport)->toBeArray();
    expect($latestReport->createdAt)->toBeString();
});
