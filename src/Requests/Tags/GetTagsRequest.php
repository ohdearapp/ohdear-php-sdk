<?php

namespace OhDear\PhpSdk\Requests\Tags;

use OhDear\PhpSdk\Dto\Tag;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetTagsRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/tags';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Tag::collect($response->json('data'));
    }
}
