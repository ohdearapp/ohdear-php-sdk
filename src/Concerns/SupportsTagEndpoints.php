<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\Tag;
use OhDear\PhpSdk\Requests\Tags\CreateTagRequest;
use OhDear\PhpSdk\Requests\Tags\GetTagsRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsTagEndpoints
{
    public function tags(): array
    {
        $request = new GetTagsRequest;

        return $this->send($request)->dtoOrFail();
    }

    public function createTag(array $data): Tag
    {
        $request = new CreateTagRequest($data);

        return $this->send($request)->dto();
    }
}
