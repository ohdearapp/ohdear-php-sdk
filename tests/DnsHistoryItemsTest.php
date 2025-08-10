<?php

use OhDear\PhpSdk\Requests\DnsHistoryItems\GetDnsHistoryItemRequest;
use OhDear\PhpSdk\Requests\DnsHistoryItems\GetDnsHistoryItemsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get DNS history items', function () {
    MockClient::global([
        GetDnsHistoryItemsRequest::class => MockResponse::fixture('dns-history-items'),
    ]);

    $dnsHistoryItems = $this->ohDear->dnsHistoryItems(82060);

    expect($dnsHistoryItems)->toBeArray();
    expect($dnsHistoryItems)->toHaveCount(1);

    foreach ($dnsHistoryItems as $historyItem) {
        expect($historyItem->id)->toBeInt();
        expect($historyItem->authoritative_nameservers)->toBeArray();
        expect($historyItem->dns_records)->toBeArray();
        expect($historyItem->raw_dns_records)->toBeArray();
        expect($historyItem->diff_summary)->toBeString();
        expect($historyItem->created_at)->toBeString();
    }
});

it('can get a single DNS history item', function () {
    MockClient::global([
        GetDnsHistoryItemRequest::class => MockResponse::fixture('dns-history-item'),
    ]);

    $historyItem = $this->ohDear->dnsHistoryItem(82060, 743116);

    expect($historyItem->id)->toBe(743116);
    expect($historyItem->authoritative_nameservers)->toBeArray();
    expect($historyItem->authoritative_nameservers)->toHaveCount(2);
    expect($historyItem->dns_records)->toBeArray();
    expect($historyItem->dns_records)->toHaveCount(7);
    expect($historyItem->raw_dns_records)->toBeArray();
    expect($historyItem->diff_summary)->toBeString();
    expect($historyItem->created_at)->toBeString();

    // Test DNS records structure
    $firstRecord = $historyItem->dns_records[0];
    expect($firstRecord['host'])->toBeString();
    expect($firstRecord['ttl'])->toBeInt();
    expect($firstRecord['class'])->toBeString();
    expect($firstRecord['type'])->toBeString();

    expect($historyItem->raw_dns_records)->toHaveKey('woz.ns.cloudflare.com');
});
