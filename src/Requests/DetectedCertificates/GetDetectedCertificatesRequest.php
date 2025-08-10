<?php

namespace OhDear\PhpSdk\Requests\DetectedCertificates;

use OhDear\PhpSdk\Dto\DetectedCertificate;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetDetectedCertificatesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/detected-certificates";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return DetectedCertificate::collect($response);
    }
}