<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\TagGroup;
use OhDear\PhpSdk\Requests\TagGroups\CreateTagGroupRequest;
use OhDear\PhpSdk\Requests\TagGroups\DeleteTagGroupRequest;
use OhDear\PhpSdk\Requests\TagGroups\GetTagGroupsRequest;
use OhDear\PhpSdk\Requests\TagGroups\UpdateTagGroupRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsTagGroupEndpoints
{
    public function tagGroups(): array
    {
        $request = new GetTagGroupsRequest();

        return $this->send($request)->dtoOrFail();
    }

    public function createTagGroup(array $data): TagGroup
    {
        $request = new CreateTagGroupRequest($data);

        return $this->send($request)->dto();
    }

    public function updateTagGroup(int $tagGroupId, array $data): TagGroup
    {
        $request = new UpdateTagGroupRequest($tagGroupId, $data);

        return $this->send($request)->dto();
    }

    public function deleteTagGroup(int $tagGroupId): self
    {
        $request = new DeleteTagGroupRequest($tagGroupId);

        $this->send($request);

        return $this;
    }
}
