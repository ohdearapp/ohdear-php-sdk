<?php

namespace OhDear\PhpSdk\Requests\Sitemap;

use OhDear\PhpSdk\Dto\Sitemap;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetSitemapRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/sitemap/{$this->monitorId}";
    }

    public function createDtoFromResponse(Response $response): Sitemap
    {
        return Sitemap::fromResponse($response->json());
    }
}
