<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\DnsBlocklistHistoryItem;
use OhDear\PhpSdk\Requests\DnsBlocklistHistoryItems\GetDnsBlocklistHistoryItemRequest;
use OhDear\PhpSdk\Requests\DnsBlocklistHistoryItems\GetDnsBlocklistHistoryItemsRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsDnsBlocklistHistoryItemsEndpoints
{
    public function dnsBlocklistHistoryItems(int $monitorId): array
    {
        $request = new GetDnsBlocklistHistoryItemsRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }

    public function dnsBlocklistHistoryItem(int $monitorId, int $dnsBlocklistHistoryItemId): DnsBlocklistHistoryItem
    {
        $request = new GetDnsBlocklistHistoryItemRequest($monitorId, $dnsBlocklistHistoryItemId);

        return $this->send($request)->dto();
    }
}
