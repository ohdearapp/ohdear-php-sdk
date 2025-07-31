<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Sitemap;
use OhDear\PhpSdk\Resources\SitemapIndex;
use OhDear\PhpSdk\Resources\SitemapIssue;
use OhDear\PhpSdk\Resources\SitemapResult;

trait ManagesSitemaps
{
    public function sitemap(int $monitorId)
    {
        $response = $this->get("sitemap/{$monitorId}") ?? [];

        $issues = $this->transformCollection($response['issues'], SitemapIssue::class);
        $sitemapIndexes = $this->transformCollection($response['sitemapIndexes'], SitemapIndex::class);
        $sitemaps = $this->transformCollection($response['sitemaps'], Sitemap::class);

        $response['issues'] = $issues;
        $response['sitemapIndexes'] = $sitemapIndexes;
        $response['sitemaps'] = $sitemaps;

        return new SitemapResult($response);
    }
}
