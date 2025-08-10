<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class Sitemap
{
    public function __construct(
        public string $checkUrl,
        public int $totalIssuesCount,
        public int $totalUrlCount,
        public bool $hasIssues,
        public array $issues,
        public array $sitemapIndexes,
        public array $sitemaps,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new static(
            checkUrl: $data['checkUrl'],
            totalIssuesCount: $data['totalIssuesCount'],
            totalUrlCount: $data['totalUrlCount'],
            hasIssues: $data['hasIssues'],
            issues: $data['issues'] ?? [],
            sitemapIndexes: $data['sitemapIndexes'] ?? [],
            sitemaps: $data['sitemaps'] ?? [],
        );
    }

    public static function collect(Response $response): array
    {
        return array_map(
            fn (array $item) => self::fromResponse($item),
            $response->json('data')
        );
    }
}