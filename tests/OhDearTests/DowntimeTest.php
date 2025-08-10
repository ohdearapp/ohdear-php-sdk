<?php

use OhDear\PhpSdk\Requests\Downtime\DeleteDowntimePeriodRequest;
use OhDear\PhpSdk\Requests\Downtime\GetDowntimeRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get downtime periods', function () {
    MockClient::global([
        GetDowntimeRequest::class => MockResponse::fixture('downtime'),
    ]);

    $downtimePeriods = $this->ohDear->downtime(82060, '2025-08-10 00:00:00', '2025-08-10 23:59:59');

    expect($downtimePeriods)->toBeArray();

    foreach ($downtimePeriods as $downtime) {
        expect($downtime->id)->toBeInt();
        expect($downtime->started_at)->toBeString();
    }
});

it('can delete a downtime period', function () {
    MockClient::global([
        DeleteDowntimePeriodRequest::class => MockResponse::make(status: 204),
    ]);

    $this->ohDear->deleteDowntimePeriod(25774283);

    markTestComplete();
});
