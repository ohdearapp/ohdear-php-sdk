<?php

namespace OhDear\PhpSdk\Resources;

class SitemapIndex extends ApiResource
{
    public string $url;

    /**
     * @var array<SitemapIssue>
     */
    public array $issues;
}
