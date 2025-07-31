<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\DnsHistoryItem;

trait ManagesDnsHistoryItems
{
    public function dnsHistoryItems(int $monitorId): array
    {
        return $this->transformCollection(
            $this->get("monitors/{$monitorId}/dns-history-items")['data'],
            DnsHistoryItem::class,
        );
    }

    public function dnsHistoryItem(int $monitorId, int $dnsHistoryItemId): DnsHistoryItem
    {
        $dnsHistoryItem = $this->get("monitors/{$monitorId}/dns-history-items/{$dnsHistoryItemId}");

        return new DnsHistoryItem($dnsHistoryItem, $this);
    }
}
