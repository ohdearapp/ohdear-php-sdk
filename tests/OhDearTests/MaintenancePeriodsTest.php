<?php

use OhDear\PhpSdk\Requests\MaintenancePeriods\CreateMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\DeleteMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\GetMaintenancePeriodsRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\StartMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\StopMaintenancePeriodsRequest;
use OhDear\PhpSdk\Requests\MaintenancePeriods\UpdateMaintenancePeriodRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get maintenance periods for a monitor', function () {
    MockClient::global([
        GetMaintenancePeriodsRequest::class => MockResponse::fixture('maintenance-periods'),
    ]);

    $maintenancePeriods = $this->ohDear->maintenancePeriods(82060);

    foreach ($maintenancePeriods as $period) {
        expect($period->id)->toBeInt();
        expect($period->monitorId)->toBe(82060);
        expect($period->startsAt)->toBeString();
        expect($period->endsAt)->toBeString();
    }
});

it('can get maintenance periods with date filters', function () {
    MockClient::global([
        GetMaintenancePeriodsRequest::class => MockResponse::fixture('maintenance-periods'),
    ]);

    $periods = $this->ohDear->maintenancePeriods(82063, '2024-01-01 00:00:00', '2024-12-31 23:59:59');

    foreach ($periods as $period) {
        expect($period->id)->toBeInt();
    }
});

it('can start a maintenance period', function () {
    MockClient::global([
        StartMaintenancePeriodRequest::class => MockResponse::fixture('start-maintenance-period'),
    ]);

    $period = $this->ohDear->startMaintenancePeriod(82060);

    expect($period->id)->toBeInt();
    expect($period->monitorId)->toBe(82060);
});

it('can start a maintenance period with custom duration and name', function () {
    MockClient::global([
        StartMaintenancePeriodRequest::class => MockResponse::fixture('start-maintenance-period-name'),
    ]);

    $period = $this->ohDear->startMaintenancePeriod(82060, 60, 'Database Migration');

    expect($period->id)->toBeInt();
    expect($period->monitorId)->toBe(82060);
    expect($period->name)->toBe('Database Migration');
});

it('can stop maintenance periods', function () {
    MockClient::global([
        StopMaintenancePeriodsRequest::class => MockResponse::fixture('stop-maintenance-periods'),
    ]);

    $this->ohDear->stopMaintenancePeriod(82060);

    markTestComplete();
});

it('can create a scheduled maintenance period', function () {
    MockClient::global([
        CreateMaintenancePeriodRequest::class => MockResponse::fixture('create-scheduled-maintenance-period'),
    ]);

    $period = $this->ohDear->createMaintenancePeriod([
        'monitor_id' => 82060,
        'name' => 'Scheduled Server Maintenance',
        'starts_at' => '2024-12-25 02:00',
        'ends_at' => '2024-12-25 06:00',
    ]);

    expect($period->id)->toBeInt();
    expect($period->monitorId)->toBe(82060);
    expect($period->name)->toBe('Scheduled Server Maintenance');
});

it('can update a maintenance period', function () {
    MockClient::global([
        UpdateMaintenancePeriodRequest::class => MockResponse::fixture('update-maintenance-period'),
    ]);

    $period = $this->ohDear->updateMaintenancePeriod(207101, [
        'name' => 'Updated Maintenance Window',
        'starts_at' => '2024-12-25 01:00',
        'ends_at' => '2024-12-25 05:00',
    ]);

    expect($period->id)->toBe(207101);
    expect($period->name)->toBe('Updated Maintenance Window');
});

it('can delete a maintenance period', function () {
    MockClient::global([
        DeleteMaintenancePeriodRequest::class => MockResponse::fixture('delete-maintenance-period'),
    ]);

    $this->ohDear->deleteMaintenancePeriod(207101);

    markTestComplete();
});
