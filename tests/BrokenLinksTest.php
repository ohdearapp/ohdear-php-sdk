<?php

use OhDear\PhpSdk\Requests\BrokenLinks\GetBrokenLinksRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get broken links', function () {
    MockClient::global([
        GetBrokenLinksRequest::class => MockResponse::fixture('broken-links'),
    ]);

    $brokenLinks = $this->ohDear->brokenLinks(82060);

    foreach ($brokenLinks as $brokenLink) {
        expect($brokenLink->status_code)->toBeInt();
        expect($brokenLink->crawled_url)->toBeString();
        expect($brokenLink->relative_crawled_url)->toBeString();
        expect($brokenLink->found_on_url)->toBeString();
        expect($brokenLink->relative_found_on_url)->toBeString();
        expect($brokenLink->link_text)->toBeString();
        expect($brokenLink->internal)->toBeBool();
    }
});
