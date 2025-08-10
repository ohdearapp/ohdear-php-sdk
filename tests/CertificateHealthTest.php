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

    expect($certificateHealth->certificate_details)->toBeArray();
    expect($certificateHealth->certificate_checks)->toBeArray();
    expect($certificateHealth->certificate_chain_issuers)->toBeArray();
});
