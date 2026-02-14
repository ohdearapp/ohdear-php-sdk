<?php

use OhDear\PhpSdk\Requests\DnsBlocklistHistoryItems\GetDnsBlocklistHistoryItemRequest;
use OhDear\PhpSdk\Requests\DnsBlocklistHistoryItems\GetDnsBlocklistHistoryItemsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get dns blocklist history items', function () {
    MockClient::global([
        GetDnsBlocklistHistoryItemsRequest::class => MockResponse::fixture('dns-blocklist-history-items'),
    ]);

    $items = $this->ohDear->dnsBlocklistHistoryItems(82060);

    expect($items)->toBeArray();
    foreach ($items as $item) {
        expect($item->id)->toBeInt();
        expect($item->domain)->toBeString();
    }
});

it('can get a single dns blocklist history item', function () {
    MockClient::global([
        GetDnsBlocklistHistoryItemRequest::class => MockResponse::fixture('dns-blocklist-history-item'),
    ]);

    $item = $this->ohDear->dnsBlocklistHistoryItem(82060, 1);

    expect($item->id)->toBe(1);
    expect($item->domain)->toBe('example.com');
    expect($item->resolvedIps)->toBeArray();
    expect($item->blocklists)->toBeArray();
});
