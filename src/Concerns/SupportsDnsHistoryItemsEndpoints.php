<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\DnsHistoryItem;
use OhDear\PhpSdk\Requests\DnsHistoryItems\GetDnsHistoryItemRequest;
use OhDear\PhpSdk\Requests\DnsHistoryItems\GetDnsHistoryItemsRequest;

trait SupportsDnsHistoryItemsEndpoints
{
    public function dnsHistoryItems(int $monitorId): array
    {
        $request = new GetDnsHistoryItemsRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }

    public function dnsHistoryItem(int $monitorId, int $dnsHistoryItemId): DnsHistoryItem
    {
        $request = new GetDnsHistoryItemRequest($monitorId, $dnsHistoryItemId);

        return $this->send($request)->dtoOrFail();
    }
}