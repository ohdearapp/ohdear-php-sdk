<?php

namespace OhDear\PhpSdk\Requests\BrokenLinks;

use OhDear\PhpSdk\Dto\BrokenLink;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetBrokenLinksRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/broken-links/{$this->monitorId}";
    }

    /** @return array<int, BrokenLink> */
    public function createDtoFromResponse(Response $response): array
    {
        return BrokenLink::collect($response->json('data'));
    }
}
