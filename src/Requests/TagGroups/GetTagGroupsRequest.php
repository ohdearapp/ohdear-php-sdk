<?php

namespace OhDear\PhpSdk\Requests\TagGroups;

use OhDear\PhpSdk\Dto\TagGroup;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetTagGroupsRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/tag-groups';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return TagGroup::collect($response->json('data'));
    }
}
