<?php

namespace OhDear\PhpSdk\Requests\MixedContent;

use OhDear\PhpSdk\Dto\MixedContent;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetMixedContentRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/mixed-content/{$this->monitorId}";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return MixedContent::collect($response);
    }
}