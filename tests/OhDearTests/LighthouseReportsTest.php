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
        expect($report->performance_score)->toBeInt();
        expect($report->accessibility_score)->toBeInt();
        expect($report->best_practices_score)->toBeInt();
        expect($report->seo_score)->toBeInt();
        expect($report->progressive_web_app_score)->toBeInt();
        expect($report->first_contentful_paint_in_ms)->toBeFloat();
        expect($report->speed_index_in_ms)->toBeFloat();
        expect($report->largest_contentful_paint_in_ms)->toBeFloat();
        expect($report->time_to_interactive_in_ms)->toBeFloat();
        expect($report->total_blocking_time_in_ms)->toBeFloat();
        expect($report->cumulative_layout_shift)->toBeFloat();
        expect($report->performed_on_checker_server)->toBeString();
        expect($report->created_at)->toBeString();
    }
});

it('can get a single lighthouse report', function () {
    MockClient::global([
        GetLighthouseReportRequest::class => MockResponse::fixture('lighthouse-report'),
    ]);

    $report = $this->ohDear->lighthouseReport(82060, 2851696);

    expect($report->id)->toBeInt();
    expect($report->performance_score)->toBeInt();
    expect($report->accessibility_score)->toBeInt();
    expect($report->best_practices_score)->toBeInt();
    expect($report->seo_score)->toBeInt();
    expect($report->progressive_web_app_score)->toBeInt();
    expect($report->first_contentful_paint_in_ms)->toBeFloat();
    expect($report->speed_index_in_ms)->toBeFloat();
    expect($report->largest_contentful_paint_in_ms)->toBeFloat();
    expect($report->time_to_interactive_in_ms)->toBeFloat();
    expect($report->total_blocking_time_in_ms)->toBeFloat();
    expect($report->cumulative_layout_shift)->toBeFloat();
    expect($report->performed_on_checker_server)->toBeString();
    expect($report->json_report)->toBeArray();
    expect($report->created_at)->toBeString();
});

it('can get the latest lighthouse report', function () {
    MockClient::global([
        GetLatestLighthouseReportRequest::class => MockResponse::fixture('latest-lighthouse-report'),
    ]);

    $latestReport = $this->ohDear->latestLighthouseReport(82060);

    expect($latestReport->id)->toBeInt();
    expect($latestReport->performance_score)->toBeInt();
    expect($latestReport->accessibility_score)->toBeInt();
    expect($latestReport->best_practices_score)->toBeInt();
    expect($latestReport->seo_score)->toBeInt();
    expect($latestReport->progressive_web_app_score)->toBeInt();
    expect($latestReport->first_contentful_paint_in_ms)->toBeFloat();
    expect($latestReport->speed_index_in_ms)->toBeFloat();
    expect($latestReport->largest_contentful_paint_in_ms)->toBeFloat();
    expect($latestReport->time_to_interactive_in_ms)->toBeFloat();
    expect($latestReport->total_blocking_time_in_ms)->toBeFloat();
    expect($latestReport->cumulative_layout_shift)->toBeFloat();
    expect($latestReport->performed_on_checker_server)->toBeString();
    expect($latestReport->json_report)->toBeArray();
    expect($latestReport->created_at)->toBeString();
});
