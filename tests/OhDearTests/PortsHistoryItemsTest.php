<?php

use OhDear\PhpSdk\Requests\PortsHistoryItems\GetPortsHistoryItemRequest;
use OhDear\PhpSdk\Requests\PortsHistoryItems\GetPortsHistoryItemsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get ports history items', function () {
    MockClient::global([
        GetPortsHistoryItemsRequest::class => MockResponse::fixture('ports-history-items'),
    ]);

    $items = $this->ohDear->portsHistoryItems(82060);

    expect($items)->toBeArray();
    foreach ($items as $item) {
        expect($item->id)->toBeInt();
        expect($item->scannedHost)->toBeString();
    }
});

it('can get a single ports history item', function () {
    MockClient::global([
        GetPortsHistoryItemRequest::class => MockResponse::fixture('ports-history-item'),
    ]);

    $item = $this->ohDear->portsHistoryItem(82060, 1);

    expect($item->id)->toBe(1);
    expect($item->scannedHost)->toBe('example.com');
    expect($item->resolvedIp)->toBe('93.184.216.34');
    expect($item->openPorts)->toBe([80, 443]);
    expect($item->scanTimeMs)->toBe(1500);
});
