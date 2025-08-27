<?php

use OhDear\PhpSdk\Requests\Uptime\GetUptimeRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get uptime periods', function () {
    MockClient::global([
        GetUptimeRequest::class => MockResponse::fixture('uptime'),
    ]);

    $uptimePeriods = $this->ohDear->uptime(82065, '2025-08-25 00:00:00', '2025-08-26 23:59:59');

    expect($uptimePeriods)->toBeArray();

    foreach ($uptimePeriods as $uptime) {
        expect($uptime->datetime)->toBeString();
        expect($uptime->uptimePercentage)->toBeFloat();
    }
});
