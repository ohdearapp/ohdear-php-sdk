<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\StatusPage;
use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPageRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPagesRequest;
use OhDear\PhpSdk\Requests\StatusPages\UpdateStatusPageRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsStatusPageEndpoints
{
    /** @return iterable<int, StatusPage> */
    public function statusPages(?int $teamId = null): iterable
    {
        $request = new GetStatusPagesRequest($teamId);

        return $this->paginate($request)->items();
    }

    public function statusPage(int $statusPageId): StatusPage
    {
        $request = new GetStatusPageRequest($statusPageId);

        return $this->send($request)->dto();
    }

    public function deleteStatusPage(int $statusPageId): self
    {
        $request = new DeleteStatusPageRequest($statusPageId);

        $this->send($request);

        return $this;
    }
}
