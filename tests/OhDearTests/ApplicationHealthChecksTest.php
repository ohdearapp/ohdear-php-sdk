<?php

use OhDear\PhpSdk\Requests\ApplicationHealthChecks\GetApplicationHealthCheckHistoryRequest;
use OhDear\PhpSdk\Requests\ApplicationHealthChecks\GetApplicationHealthChecksRequest;
use OhDear\PhpSdk\Requests\ApplicationHealthChecks\SnoozeApplicationHealthCheckRequest;
use OhDear\PhpSdk\Requests\ApplicationHealthChecks\UnsnoozeApplicationHealthCheckRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get application health checks', function () {
    MockClient::global([
        GetApplicationHealthChecksRequest::class => MockResponse::fixture('application-health-checks'),
    ]);

    $healthChecks = $this->ohDear->applicationHealthChecks(82060);

    expect($healthChecks)->toBeArray();

    foreach ($healthChecks as $healthCheck) {
        expect($healthCheck->id)->toBeInt();
        expect($healthCheck->name)->toBeString();
        expect($healthCheck->label)->toBeString();
        expect($healthCheck->meta)->toBeArray();
        expect($healthCheck->shortSummary)->toBeString();
        expect($healthCheck->detectedAt)->toBeString();
        expect($healthCheck->updatedAt)->toBeString();
    }
});

it('can get application health check history', function () {
    MockClient::global([
        GetApplicationHealthCheckHistoryRequest::class => MockResponse::fixture('application-health-check-history'),
    ]);

    $history = $this->ohDear->applicationHealthCheckHistory(82060, 2608325);

    expect($history)->toBeArray();

    foreach ($history as $historyItem) {
        expect($historyItem->id)->toBeInt();
        expect($historyItem->status)->toBeString();
        expect($historyItem->shortSummary)->toBeString();
        expect($historyItem->detectedAt)->toBeString();
        expect($historyItem->updatedAt)->toBeString();
    }
});

it('can snooze an application health check', function () {
    MockClient::global([
        SnoozeApplicationHealthCheckRequest::class => MockResponse::fixture('snooze-application-health-check'),
    ]);

    $healthCheck = $this->ohDear->snoozeApplicationHealthCheck(82060, 2608325, 60);

    expect($healthCheck->id)->toBe(2608325);
    expect($healthCheck->name)->toBe('Database');
    expect($healthCheck->activeSnooze)->toBeArray();
});

it('can unsnooze an application health check', function () {
    MockClient::global([
        UnsnoozeApplicationHealthCheckRequest::class => MockResponse::fixture('unsnooze-application-health-check'),
    ]);

    $healthCheck = $this->ohDear->unsnoozeApplicationHealthCheck(82060, 2608325);

    expect($healthCheck->id)->toBe(2608325);
    expect($healthCheck->name)->toBe('Database');
    expect($healthCheck->activeSnooze)->toBeNull();
});
