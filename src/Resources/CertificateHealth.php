<?php

namespace OhDear\PhpSdk\Resources;

class CertificateHealth extends ApiResource
{
    public array $certificateDetails;

    public array $certificateChecks;

    /*
     * An array with all the issuer names in the chain of the certificate.
     */
    public array $certificateChainIssuers;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
