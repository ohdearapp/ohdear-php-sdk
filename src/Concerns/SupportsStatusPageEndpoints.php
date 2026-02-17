<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\StatusPage;
use OhDear\PhpSdk\Dto\StatusPageUpdate;
use OhDear\PhpSdk\Requests\StatusPages\AddStatusPageMonitorsRequest;
use OhDear\PhpSdk\Requests\StatusPages\CreateStatusPageRequest;
use OhDear\PhpSdk\Requests\StatusPages\CreateStatusPageUpdateRequest;
use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageMonitorRequest;
use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageRequest;
use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageUpdateRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPageRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPagesRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPageUpdatesRequest;
use OhDear\PhpSdk\Requests\StatusPages\UpdateStatusPageUpdateRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsStatusPageEndpoints
{
    /** @return iterable<int, StatusPage> */
    public function statusPages(?int $teamId = null): iterable
    {
        $request = new GetStatusPagesRequest($teamId);

        /** @var iterable<int, StatusPage> $items */
        $items = $this->paginate($request)->items();

        return $items;
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

    public function createStatusPageUpdate(array $data): StatusPageUpdate
    {
        $request = new CreateStatusPageUpdateRequest($data);

        return $this->send($request)->dto();
    }

    public function deleteStatusPageUpdate(int $statusPageUpdateId): self
    {
        $request = new DeleteStatusPageUpdateRequest($statusPageUpdateId);

        $this->send($request);

        return $this;
    }

    public function createStatusPage(array $data): StatusPage
    {
        $request = new CreateStatusPageRequest($data);

        return $this->send($request)->dto();
    }

    public function addStatusPageMonitors(int $statusPageId, array $data): StatusPage
    {
        $request = new AddStatusPageMonitorsRequest($statusPageId, $data);

        return $this->send($request)->dto();
    }

    public function deleteStatusPageMonitor(int $statusPageId, int $monitorId): self
    {
        $request = new DeleteStatusPageMonitorRequest($statusPageId, $monitorId);

        $this->send($request);

        return $this;
    }

    public function statusPageUpdates(int $statusPageId): array
    {
        $request = new GetStatusPageUpdatesRequest($statusPageId);

        return $this->send($request)->dtoOrFail();
    }

    public function updateStatusPageUpdate(int $statusPageUpdateId, array $data): StatusPageUpdate
    {
        $request = new UpdateStatusPageUpdateRequest($statusPageUpdateId, $data);

        return $this->send($request)->dto();
    }
}
