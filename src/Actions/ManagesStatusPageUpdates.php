<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\StatusPageUpdate;

trait ManagesStatusPageUpdates
{
    public function statusPageUpdates(int $statusPageId): array
    {
        return $this->transformCollection(
            $this->get("status-pages/{$statusPageId}/updates")['data'],
            StatusPageUpdate::class
        );
    }

    public function createStatusPageUpdate(array $data): StatusPageUpdate
    {
        $statusPageAttributes = $this->post('status-page-updates', $data);

        return new StatusPageUpdate($statusPageAttributes, $this);
    }

    public function deleteStatusPageUpdate(int $statusPageUpdateId)
    {
        $this->delete("status-page-updates/{$statusPageUpdateId}");
    }
}
