<?php

use OhDear\PhpSdk\Enums\UptimeMetricsSplit;
use OhDear\PhpSdk\Requests\UptimeMetrics\GetHttpUptimeMetricsRequest;
use OhDear\PhpSdk\Requests\UptimeMetrics\GetPingUptimeMetricsRequest;
use OhDear\PhpSdk\Requests\UptimeMetrics\GetTcpUptimeMetricsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get HTTP uptime metrics', function () {
    MockClient::global([
        GetHttpUptimeMetricsRequest::class => MockResponse::fixture('http-uptime-metrics'),
    ]);

    $startDate = date('Y-m-d H:i:s', strtotime('-24 hours'));
    $endDate = date('Y-m-d H:i:s');

    $metrics = $this->ohDear->httpUptimeMetrics(82060, $startDate, $endDate, UptimeMetricsSplit::Hour);

    foreach ($metrics as $metric) {
        expect($metric->dns_time_in_seconds)->toBeFloat();
        expect($metric->tcp_time_in_seconds)->toBeFloat();
        expect($metric->ssl_handshake_time_in_seconds)->toBeFloat();
        expect($metric->remote_server_processing_time_in_seconds)->toBeFloat();
        expect($metric->download_time_in_seconds)->toBeFloat();
        expect($metric->total_time_in_seconds)->toBeFloat();
        expect($metric->curl)->toBeArray();
        expect($metric->date)->toBeString();
    }
});

it('can get ping uptime metrics', function () {
    MockClient::global([
        GetPingUptimeMetricsRequest::class => MockResponse::fixture('ping-uptime-metrics'),
    ]);

    $startDate = date('Y-m-d H:i:s', strtotime('-24 hours'));
    $endDate = date('Y-m-d H:i:s');

    $metrics = $this->ohDear->pingUptimeMetrics(82060, $startDate, $endDate, UptimeMetricsSplit::Hour);

    foreach ($metrics as $metric) {
        expect($metric->minimum_time_in_ms)->toBeFloat();
        expect($metric->maximum_time_in_ms)->toBeFloat();
        expect($metric->average_time_in_ms)->toBeFloat();
        expect($metric->packet_loss_percentage)->toBeFloat();
        expect($metric->uptime_percentage)->toBeFloat();
        expect($metric->downtime_percentage)->toBeFloat();
        expect($metric->uptime_seconds)->toBeInt();
        expect($metric->downtime_seconds)->toBeInt();
        expect($metric->date)->toBeString();
    }
});

it('can get TCP uptime metrics', function () {
    MockClient::global([
        GetTcpUptimeMetricsRequest::class => MockResponse::fixture('tcp-uptime-metrics'),
    ]);

    $startDate = date('Y-m-d H:i:s', strtotime('-24 hours'));
    $endDate = date('Y-m-d H:i:s');

    $metrics = $this->ohDear->tcpUptimeMetrics(82060, $startDate, $endDate, UptimeMetricsSplit::Hour);

    foreach ($metrics as $metric) {
        expect($metric->time_to_connect_in_ms)->toBeFloat();
        expect($metric->uptime_percentage)->toBeFloat();
        expect($metric->downtime_percentage)->toBeFloat();
        expect($metric->uptime_seconds)->toBeInt();
        expect($metric->downtime_seconds)->toBeInt();
        expect($metric->date)->toBeString();
    }
});

it('uptime metrics methods return arrays not iterables', function () {
    MockClient::global([
        GetHttpUptimeMetricsRequest::class => MockResponse::fixture('http-uptime-metrics'),
        GetPingUptimeMetricsRequest::class => MockResponse::fixture('ping-uptime-metrics'),
        GetTcpUptimeMetricsRequest::class => MockResponse::fixture('tcp-uptime-metrics'),
    ]);

    $startDate = '2024-01-01 10:00:00';
    $endDate = '2024-01-01 12:00:00';

    $httpMetrics = $this->ohDear->httpUptimeMetrics(82060, $startDate, $endDate, UptimeMetricsSplit::Hour);
    $pingMetrics = $this->ohDear->pingUptimeMetrics(82060, $startDate, $endDate, UptimeMetricsSplit::Hour);
    $tcpMetrics = $this->ohDear->tcpUptimeMetrics(82060, $startDate, $endDate, UptimeMetricsSplit::Hour);

    expect($httpMetrics)->toBeArray();
    expect($pingMetrics)->toBeArray();
    expect($tcpMetrics)->toBeArray();
});
