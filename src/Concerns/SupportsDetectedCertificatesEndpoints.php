<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\DetectedCertificate;
use OhDear\PhpSdk\Requests\DetectedCertificates\GetDetectedCertificateRequest;
use OhDear\PhpSdk\Requests\DetectedCertificates\GetDetectedCertificatesRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsDetectedCertificatesEndpoints
{
    public function detectedCertificates(int $monitorId): array
    {
        $request = new GetDetectedCertificatesRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }

    public function detectedCertificate(int $monitorId, int $detectedCertificateId): DetectedCertificate
    {
        $request = new GetDetectedCertificateRequest($monitorId, $detectedCertificateId);

        return $this->send($request)->dtoOrFail();
    }
}
