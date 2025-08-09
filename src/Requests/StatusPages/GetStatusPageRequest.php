<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use OhDear\PhpSdk\Dto\StatusPage;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetStatusPageRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $statusPageId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/status-pages/{$this->statusPageId}";
    }

    public function createDtoFromResponse(Response $response): StatusPage
    {
        return StatusPage::fromResponse($response->json());
    }
}