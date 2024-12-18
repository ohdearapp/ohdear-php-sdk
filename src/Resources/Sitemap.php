<?php

namespace OhDear\PhpSdk\Resources;

class Sitemap extends ApiResource
{
    public string $url;

    public int $urlCount;

    public bool $checkedReachabilityOfAllUrls;

    public int $issuesCount;

    /**
     * @var array<SitemapIssue>
     */
    public array $issues;
}
