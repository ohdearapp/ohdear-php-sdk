<?php

namespace OhDear\PhpSdk\Requests\Domain;

use OhDear\PhpSdk\Dto\DomainInfo;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetDomainRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/domain";
    }

    public function createDtoFromResponse(Response $response): DomainInfo
    {
        return DomainInfo::fromResponse($response->json());
    }
}
