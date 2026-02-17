<?php

use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\CreateRecurringMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\DeleteRecurringMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\GetRecurringMaintenancePeriodRequest;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\GetRecurringMaintenancePeriodsRequest;
use OhDear\PhpSdk\Requests\RecurringMaintenancePeriods\UpdateRecurringMaintenancePeriodRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get recurring maintenance periods', function () {
    MockClient::global([
        GetRecurringMaintenancePeriodsRequest::class => MockResponse::fixture('recurring-maintenance-periods'),
    ]);

    $periods = $this->ohDear->recurringMaintenancePeriods(82060);

    expect($periods)->toBeArray();
    foreach ($periods as $period) {
        expect($period->id)->toBeInt();
        expect($period->monitorId)->toBe(82060);
    }
});

it('can get a single recurring maintenance period', function () {
    MockClient::global([
        GetRecurringMaintenancePeriodRequest::class => MockResponse::fixture('recurring-maintenance-period'),
    ]);

    $period = $this->ohDear->recurringMaintenancePeriod(1);

    expect($period->id)->toBe(1);
    expect($period->monitorId)->toBe(82060);
    expect($period->name)->toBe('Weekly Maintenance');
    expect($period->recurrenceType)->toBe('weekly');
});

it('can create a recurring maintenance period', function () {
    MockClient::global([
        CreateRecurringMaintenancePeriodRequest::class => MockResponse::fixture('create-recurring-maintenance-period'),
    ]);

    $period = $this->ohDear->createRecurringMaintenancePeriod([
        'monitor_id' => 82060,
        'name' => 'Daily Maintenance',
        'recurrence_type' => 'daily',
        'start_time' => '03:00',
        'end_time' => '05:00',
    ]);

    expect($period->id)->toBe(2);
    expect($period->name)->toBe('Daily Maintenance');
    expect($period->recurrenceType)->toBe('daily');
});

it('can update a recurring maintenance period', function () {
    MockClient::global([
        UpdateRecurringMaintenancePeriodRequest::class => MockResponse::fixture('update-recurring-maintenance-period'),
    ]);

    $period = $this->ohDear->updateRecurringMaintenancePeriod(1, [
        'name' => 'Updated Maintenance',
        'start_time' => '01:00',
        'end_time' => '03:00',
    ]);

    expect($period->id)->toBe(1);
    expect($period->name)->toBe('Updated Maintenance');
});

it('can delete a recurring maintenance period', function () {
    MockClient::global([
        DeleteRecurringMaintenancePeriodRequest::class => MockResponse::fixture('delete-recurring-maintenance-period'),
    ]);

    $this->ohDear->deleteRecurringMaintenancePeriod(1);

    markTestComplete();
});
