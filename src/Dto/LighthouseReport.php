<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class LighthouseReport
{
    public function __construct(
        public int $id,
        public ?int $performance_score,
        public ?int $accessibility_score,
        public ?int $best_practices_score,
        public ?int $seo_score,
        public ?int $progressive_web_app_score,
        public ?float $first_contentful_paint_in_ms,
        public ?float $speed_index_in_ms,
        public ?float $largest_contentful_paint_in_ms,
        public ?float $time_to_interactive_in_ms,
        public ?float $total_blocking_time_in_ms,
        public ?float $cumulative_layout_shift,
        public ?string $performed_on_checker_server,
        public ?array $json_report,
        public ?array $issues,
        public string $created_at,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            id: $data['id'],
            performance_score: $data['performance_score'],
            accessibility_score: $data['accessibility_score'],
            best_practices_score: $data['best_practices_score'],
            seo_score: $data['seo_score'],
            progressive_web_app_score: $data['progressive_web_app_score'],
            first_contentful_paint_in_ms: $data['first_contentful_paint_in_ms'],
            speed_index_in_ms: $data['speed_index_in_ms'],
            largest_contentful_paint_in_ms: $data['largest_contentful_paint_in_ms'],
            time_to_interactive_in_ms: $data['time_to_interactive_in_ms'],
            total_blocking_time_in_ms: $data['total_blocking_time_in_ms'],
            cumulative_layout_shift: $data['cumulative_layout_shift'],
            performed_on_checker_server: $data['performed_on_checker_server'],
            json_report: $data['json_report'] ?? null,
            issues: $data['issues'],
            created_at: $data['created_at'],
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
