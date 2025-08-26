<?php

use OhDear\PhpSdk\Requests\Sitemap\GetSitemapRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get sitemap analysis', function () {
    MockClient::global([
        GetSitemapRequest::class => MockResponse::fixture('sitemap'),
    ]);

    $sitemap = $this->ohDear->sitemap(82066);

    expect($sitemap->checkUrl)->toBeString();
    expect($sitemap->totalIssuesCount)->toBeInt();
    expect($sitemap->totalUrlCount)->toBeInt();
    expect($sitemap->hasIssues)->toBeBool();
    expect($sitemap->issues)->toBeArray();
    expect($sitemap->sitemapIndexes)->toBeArray();
    expect($sitemap->sitemaps)->toBeArray();
});
