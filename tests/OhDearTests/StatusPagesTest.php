<?php

use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPageRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPagesRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get status pages', function () {
    MockClient::global([
        GetStatusPagesRequest::class => MockResponse::fixture('status-pages'),
    ]);

    $statusPages = $this->ohDear->statusPages();
    foreach ($statusPages as $statusPage) {
        expect($statusPage->id)->toBeInt();
        expect($statusPage->title)->toBeString();
    }
});

it('can get a single status page', function () {
    MockClient::global([
        GetStatusPageRequest::class => MockResponse::fixture('status-page'),
    ]);

    $statusPage = $this->ohDear->statusPage(9338);

    expect($statusPage->title)->toBe('First status page');
});

it('can delete a status page', function () {
    MockClient::global([
        DeleteStatusPageRequest::class => MockResponse::fixture('delete-status-page'),
    ]);

    $this->ohDear->deleteStatusPage(9338);

    markTestComplete();
});
