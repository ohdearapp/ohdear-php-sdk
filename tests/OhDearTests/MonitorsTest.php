<?php

use OhDear\PhpSdk\Enums\CheckType;
use OhDear\PhpSdk\Requests\Monitors\CreateMonitorRequest;
use OhDear\PhpSdk\Requests\Monitors\DeleteMonitorRequest;
use OhDear\PhpSdk\Requests\Monitors\GetCheckSummaryRequest;
use OhDear\PhpSdk\Requests\Monitors\GetMonitorRequest;
use OhDear\PhpSdk\Requests\Monitors\GetMonitorsRequest;
use OhDear\PhpSdk\Requests\Monitors\GetNotificationDestinationsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get monitors', function () {
    MockClient::global([
        GetMonitorsRequest::class => MockResponse::fixture('monitors'),
    ]);

    $monitors = $this->ohDear->monitors();
    foreach ($monitors as $monitor) {
        expect($monitor->teamId)->toBeInt();
    }
});

it('can get a single monitor', function () {
    MockClient::global([
        GetMonitorRequest::class => MockResponse::fixture('monitor'),
    ]);

    $monitor = $this->ohDear->monitor(82063);

    expect($monitor->url)->toBe('https://laravel.com');
});

it('can create a monitor', function () {
    MockClient::global([
        CreateMonitorRequest::class => MockResponse::fixture('create-monitor'),
    ]);

    $monitor = $this->ohDear->createMonitor([
        'url' => 'https://example.com',
        'description' => 'Test monitor description',
        'team_id' => 19245,
        'type' => 'http',
    ]);

    expect($monitor->id)->toBeInt('19245');
    expect($monitor->url)->toBe('https://example.com');
    expect($monitor->description)->toBe('Test monitor description');
    expect($monitor->teamId)->toBe(19245);
});

it('can delete a monitor', function () {
    MockClient::global([
        DeleteMonitorRequest::class => MockResponse::fixture('delete-monitor'),
    ]);

    $this->ohDear->deleteMonitor(82065);

    markTestComplete();
});

it('can get check summary for a monitor', function () {
    MockClient::global([
        GetCheckSummaryRequest::class => MockResponse::fixture('check-summary'),
    ]);

    $checkSummary = $this->ohDear->checkSummary(82060, CheckType::CertificateHealth);

    expect($checkSummary->result)->toBe('succeeded');
});

it('can get notification destinations for a monitor', function () {
    MockClient::global([
        GetNotificationDestinationsRequest::class => MockResponse::fixture('notification-destinations'),
    ]);

    $notificationDestinations = $this->ohDear->notificationDestinations(82060);

    foreach ($notificationDestinations as $notificationDestination) {
        expect($notificationDestination->id)->toBeInt();
    }
});
