<?php

use OhDear\PhpSdk\OhDear;
use OhDear\PhpSdk\Requests\MeRequest;
use OhDear\PhpSdk\Requests\Monitors\GetMonitorRequest;
use OhDear\PhpSdk\Requests\Monitors\GetMonitorsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\MockConfig;

it('can get monitors', function() {
    MockClient::global([
        GetMonitorsRequest::class => MockResponse::fixture('monitors'),
    ]);

    $monitors = $this->ohDear->monitors();
    foreach($monitors as $monitor) {
        expect($monitor->teamId)->toBeInt();
    }
});

it('can get a single monitor', function() {
    MockClient::global([
        GetMonitorRequest::class => MockResponse::fixture('monitor'),
    ]);

    $monitor = $this->ohDear->monitor(82063);

    expect($monitor->url)->toBe('https://laravel.com');
});

