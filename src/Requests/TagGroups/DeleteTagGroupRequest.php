<?php

namespace OhDear\PhpSdk\Requests\TagGroups;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteTagGroupRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $tagGroupId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/tag-groups/{$this->tagGroupId}";
    }
}
