<?php

use OhDear\PhpSdk\Requests\DetectedCertificates\GetDetectedCertificateRequest;
use OhDear\PhpSdk\Requests\DetectedCertificates\GetDetectedCertificatesRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get detected certificates', function () {
    MockClient::global([
        GetDetectedCertificatesRequest::class => MockResponse::fixture('detected-certificates'),
    ]);

    $detectedCertificates = $this->ohDear->detectedCertificates(82060);

    expect($detectedCertificates)->toBeArray();
    expect($detectedCertificates)->toHaveCount(1);

    foreach ($detectedCertificates as $certificate) {
        expect($certificate->id)->toBeInt();
        expect($certificate->monitorId)->toBeInt();
        expect($certificate->fingerprint)->toBeString();
        expect($certificate->certificateDetails)->toBeArray();
        expect($certificate->createdAt)->toBeString();
        expect($certificate->updatedAt)->toBeString();
    }
});

it('can get a single detected certificate', function () {
    MockClient::global([
        GetDetectedCertificateRequest::class => MockResponse::fixture('detected-certificate'),
    ]);

    $certificate = $this->ohDear->detectedCertificate(82060, 10);

    expect($certificate->id)->toBe(10);
    expect($certificate->monitorId)->toBe(82060);
    expect($certificate->fingerprint)->toBeString();
    expect($certificate->certificateDetails)->toBeArray();
    expect($certificate->createdAt)->toBeString();
    expect($certificate->updatedAt)->toBeString();

    // Test certificate details structure
    $details = $certificate->certificateDetails;
    expect($details['issuer'])->toBeString();
    expect($details['domain'])->toBeString();
    expect($details['additional_domains'])->toBeArray();
    expect($details['valid_from'])->toBeString();
    expect($details['valid_until'])->toBeString();
    expect($details['days_until_expiration'])->toBeInt();
    expect($details['signature_algorithm'])->toBeString();
    expect($details['is_valid'])->toBeBool();
    expect($details['is_expired'])->toBeBool();
});
