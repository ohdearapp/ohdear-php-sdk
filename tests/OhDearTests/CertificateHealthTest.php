<?php

use OhDear\PhpSdk\Requests\CertificateHealth\GetCertificateHealthRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get certificate health', function () {
    MockClient::global([
        GetCertificateHealthRequest::class => MockResponse::fixture('certificate-health'),
    ]);

    $certificateHealth = $this->ohDear->certificateHealth(82060);

    expect($certificateHealth->certificateDetails)->toBeArray();
    expect($certificateHealth->certificateChecks)->toBeArray();
    expect($certificateHealth->certificateChainIssuers)->toBeArray();
});
