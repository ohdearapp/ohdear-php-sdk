<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\SitemapResult;
use OhDear\PhpSdk\Resources\SitemapIndex;
use OhDear\PhpSdk\Resources\SitemapIssue;
use OhDear\PhpSdk\Resources\Sitemap;

trait ManagesSitemaps
{
    public function sitemap(int $siteId)
    {
        $response = $this->get("sitemap/{$siteId}") ?? [];

        $issues = $this->transformCollection($response['issues'], SitemapIssue::class);
        $sitemapIndexes = $this->transformCollection($response['sitemapIndexes'], SitemapIndex::class);
        $sitemaps = $this->transformCollection($response['sitemaps'], Sitemap::class);

        $response['issues'] = $issues;
        $response['sitemapIndexes'] = $sitemapIndexes;
        $response['sitemaps'] = $sitemaps;

        return new SitemapResult($response);
    }
}
