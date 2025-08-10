<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class LighthouseReport
{
    public function __construct(
        public int $id,
        public ?int $performanceScore,
        public ?int $accessibilityScore,
        public ?int $bestPracticesScore,
        public ?int $seoScore,
        public ?int $progressiveWebAppScore,
        public ?float $firstContentfulPaintInMs,
        public ?float $speedIndexInMs,
        public ?float $largestContentfulPaintInMs,
        public ?float $timeToInteractiveInMs,
        public ?float $totalBlockingTimeInMs,
        public ?float $cumulativeLayoutShift,
        public ?string $performedOnCheckerServer,
        public ?array $jsonReport,
        public ?array $issues,
        public string $createdAt,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            id: $data['id'],
            performanceScore: $data['performance_score'],
            accessibilityScore: $data['accessibility_score'],
            bestPracticesScore: $data['best_practices_score'],
            seoScore: $data['seo_score'],
            progressiveWebAppScore: $data['progressive_web_app_score'],
            firstContentfulPaintInMs: $data['first_contentful_paint_in_ms'],
            speedIndexInMs: $data['speed_index_in_ms'],
            largestContentfulPaintInMs: $data['largest_contentful_paint_in_ms'],
            timeToInteractiveInMs: $data['time_to_interactive_in_ms'],
            totalBlockingTimeInMs: $data['total_blocking_time_in_ms'],
            cumulativeLayoutShift: $data['cumulative_layout_shift'],
            performedOnCheckerServer: $data['performed_on_checker_server'],
            jsonReport: $data['json_report'] ?? null,
            issues: $data['issues'],
            createdAt: $data['created_at'],
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
