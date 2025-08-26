<?php

namespace OhDear\PhpSdk\Requests\CertificateHealth;

use OhDear\PhpSdk\Dto\CertificateHealth;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetCertificateHealthRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/certificate-health/{$this->monitorId}";
    }

    public function createDtoFromResponse(Response $response): CertificateHealth
    {
        return CertificateHealth::fromResponse($response->json());
    }
}
