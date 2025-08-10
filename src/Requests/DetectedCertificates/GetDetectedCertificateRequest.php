<?php

namespace OhDear\PhpSdk\Requests\DetectedCertificates;

use OhDear\PhpSdk\Dto\DetectedCertificate;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetDetectedCertificateRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected int $detectedCertificateId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/detected-certificates/{$this->detectedCertificateId}";
    }

    public function createDtoFromResponse(Response $response): DetectedCertificate
    {
        return DetectedCertificate::fromResponse($response->json());
    }
}
