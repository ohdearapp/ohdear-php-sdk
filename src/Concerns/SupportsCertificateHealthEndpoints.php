<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\CertificateHealth;
use OhDear\PhpSdk\Requests\CertificateHealth\GetCertificateHealthRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsCertificateHealthEndpoints
{
    public function certificateHealth(int $monitorId): CertificateHealth
    {
        $request = new GetCertificateHealthRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }
}
