<?php

namespace OhDear\PhpSdk\Requests\TagGroups;

use OhDear\PhpSdk\Dto\TagGroup;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateTagGroupRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $tagGroupId,
        protected array $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/tag-groups/{$this->tagGroupId}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): TagGroup
    {
        return TagGroup::fromResponse($response->json());
    }
}
