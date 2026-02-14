<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\PortsHistoryItem;
use OhDear\PhpSdk\Requests\PortsHistoryItems\GetPortsHistoryItemRequest;
use OhDear\PhpSdk\Requests\PortsHistoryItems\GetPortsHistoryItemsRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsPortsHistoryItemsEndpoints
{
    public function portsHistoryItems(int $monitorId): array
    {
        $request = new GetPortsHistoryItemsRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }

    public function portsHistoryItem(int $monitorId, int $portsHistoryItemId): PortsHistoryItem
    {
        $request = new GetPortsHistoryItemRequest($monitorId, $portsHistoryItemId);

        return $this->send($request)->dto();
    }
}
