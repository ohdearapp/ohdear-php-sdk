<?php

namespace OhDear\PhpSdk\Resources;

class CertificateHealth extends ApiResource
{
    /**
     * The details of the certificate that was found for the site.
     *
     * @var array
     */
    public $certificateDetails;

    /**
     * An array of checks that were performed on the certificate.
     *
     * @var array
     */
    public $certificateChecks;

    /**
     * An array with all the issuer names in the chain of the certificate.
     *
     * @var array
     */
    public $certificateChainIssuers;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
