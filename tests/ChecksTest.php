<?php

use OhDear\PhpSdk\Requests\Checks\DisableCheckRequest;
use OhDear\PhpSdk\Requests\Checks\EnableCheckRequest;
use OhDear\PhpSdk\Requests\Checks\RequestCheckRunRequest;
use OhDear\PhpSdk\Requests\Checks\SnoozeCheckRequest;
use OhDear\PhpSdk\Requests\Checks\UnsnoozeCheckRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});


it('can enable a check', function () {
    MockClient::global([
        EnableCheckRequest::class => MockResponse::fixture('enable-check'),
    ]);

    $check = $this->ohDear->enableCheck(940704);

    expect($check->id)->toBe(940704);
    expect($check->enabled)->toBe(true);
});

it('can disable a check', function () {
    MockClient::global([
        DisableCheckRequest::class => MockResponse::fixture('disable-check'),
    ]);

    $check = $this->ohDear->disableCheck(940704);

    expect($check->id)->toBe(940704);
    expect($check->enabled)->toBe(false);
});

it('can request a check run', function () {
    MockClient::global([
        RequestCheckRunRequest::class => MockResponse::fixture('request-check-run'),
    ]);

    $check = $this->ohDear->requestCheckRun(940705);

    expect($check->id)->toBe(940704);
});

it('can request a check run with custom headers', function () {
    MockClient::global([
        RequestCheckRunRequest::class => MockResponse::fixture('request-check-run'),
    ]);

    $check = $this->ohDear->requestCheckRun(940704, [
        'User-Agent' => 'Custom User Agent',
        'Authorization' => 'Bearer token123',
    ]);

    expect($check->id)->toBe(940704);
});

it('can snooze a check', function () {
    MockClient::global([
        SnoozeCheckRequest::class => MockResponse::fixture('snooze-check'),
    ]);

    $check = $this->ohDear->snoozeCheck(940704, 60);

    expect($check->id)->toBe(940704);
    expect($check->active_snooze)->not->toBeNull();
});

it('can unsnooze a check', function () {
    MockClient::global([
        UnsnoozeCheckRequest::class => MockResponse::fixture('unsnooze-check'),
    ]);

    $check = $this->ohDear->unsnoozeCheck(940704);

    expect($check->id)->toBe(940704);
    expect($check->active_snooze)->toBeNull();
});
