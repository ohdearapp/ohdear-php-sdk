<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\DnsHistoryItem;

trait ManagesDnsHistoryItems
{
    public function dnsHistoryItems(int $siteId): array
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/dns-history-items")['data'],
            DnsHistoryItem::class,
        );
    }

    public function dnsHistoryItem(int $siteId, int $dnsHistoryItemId): DnsHistoryItem
    {
        $dnsHistoryItem = $this->get("sites/{$siteId}/dns-history-items/{$dnsHistoryItemId}");

        return new DnsHistoryItem($dnsHistoryItem, $this);

    }
}
