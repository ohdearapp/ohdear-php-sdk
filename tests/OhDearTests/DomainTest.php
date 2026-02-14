<?php

use OhDear\PhpSdk\Requests\Domain\GetDomainRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get domain info for a monitor', function () {
    MockClient::global([
        GetDomainRequest::class => MockResponse::fixture('domain'),
    ]);

    $domain = $this->ohDear->domain(82060);

    expect($domain->expiresAt)->toBe('2026-01-01 00:00:00');
    expect($domain->registeredAt)->toBe('2020-01-01 00:00:00');
    expect($domain->domainStatuses)->toBeArray();
});
