<?php

use OhDear\PhpSdk\Requests\StatusPages\CreateStatusPageUpdateRequest;
use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageRequest;
use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageUpdateRequest;
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

it('can create a status page update', function () {
    MockClient::global([
        CreateStatusPageUpdateRequest::class => MockResponse::fixture('create-status-page-update'),
    ]);

    $statusPageUpdate = $this->ohDear->createStatusPageUpdate([
        'status_page_id' => 9338,
        'title' => 'Our site is down',
        'text' => 'We are working on it!',
        'severity' => 'high',
        'time' => '2025-01-01 00:00:00',
        'pinned' => true,
    ]);

    expect($statusPageUpdate)
        ->id->toBeInt()
        ->title->toBe('Our site is down')
        ->text->toBe('We are working on it!')
        ->severity->toBe('high')
        ->time->toBe('2025-01-01 00:00:00')
        ->pinned->toBeTrue();
});

it('can delete a status page update', function () {
    MockClient::global([
        DeleteStatusPageUpdateRequest::class => MockResponse::fixture('delete-status-page-update'),
    ]);

    $this->ohDear->deleteStatusPageUpdate(1234);

    markTestComplete();
});
