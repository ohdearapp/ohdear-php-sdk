<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use OhDear\PhpSdk\Dto\StatusPageUpdate;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetStatusPageUpdatesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $statusPageId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/status-pages/{$this->statusPageId}/updates";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return array_map(
            fn (array $item) => StatusPageUpdate::fromResponse($item),
            $response->json('data')
        );
    }
}
