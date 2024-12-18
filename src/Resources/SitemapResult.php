<?php

namespace OhDear\PhpSdk\Resources;

class SitemapResult extends ApiResource
{
    /*
     * The url that is checked.
     */
    public string $checkUrl;

    /*
     * The total number of issues found.
     */
    public int $totalIssuesCount;

    /*
     * The total number of urls found.
     */
    public int $totalUrlCount;

    /*
     * Whether there are issues found.
     */
    public bool $hasIssues;

    /*
     * A list of issues found.
     * @return array<int, SitemapIssue>
     */
    public array $issues;

    /*
     * The sitemap indexes found along with any issues.
     * @return array<int, SitemapIndex>
     */
    public array $sitemapIndexes;

    /*
     * The sitemaps found.
     * @return array<int, Sitemap>
     */
    public array $sitemaps;

    public function __construct(mixed $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
