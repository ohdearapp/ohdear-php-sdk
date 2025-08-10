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
        expect($historyItem->authoritativeNameservers)->toBeArray();
        expect($historyItem->dnsRecords)->toBeArray();
        expect($historyItem->rawDnsRecords)->toBeArray();
        expect($historyItem->diffSummary)->toBeString();
        expect($historyItem->createdAt)->toBeString();
    }
});

it('can get a single DNS history item', function () {
    MockClient::global([
        GetDnsHistoryItemRequest::class => MockResponse::fixture('dns-history-item'),
    ]);

    $historyItem = $this->ohDear->dnsHistoryItem(82060, 743116);

    expect($historyItem->id)->toBe(743116);
    expect($historyItem->authoritativeNameservers)->toBeArray();
    expect($historyItem->authoritativeNameservers)->toHaveCount(2);
    expect($historyItem->dnsRecords)->toBeArray();
    expect($historyItem->dnsRecords)->toHaveCount(7);
    expect($historyItem->rawDnsRecords)->toBeArray();
    expect($historyItem->diffSummary)->toBeString();
    expect($historyItem->createdAt)->toBeString();

    // Test DNS records structure
    $firstRecord = $historyItem->dnsRecords[0];
    expect($firstRecord['host'])->toBeString();
    expect($firstRecord['ttl'])->toBeInt();
    expect($firstRecord['class'])->toBeString();
    expect($firstRecord['type'])->toBeString();

    expect($historyItem->rawDnsRecords)->toHaveKey('woz.ns.cloudflare.com');
});
