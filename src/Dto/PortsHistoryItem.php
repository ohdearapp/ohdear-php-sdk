<?php

namespace OhDear\PhpSdk\Dto;

class PortsHistoryItem
{
    public function __construct(
        public int $id,
        public ?string $scannedHost,
        public array $expectedOpenResults,
        public array $expectedClosedResults,
        public array $issues,
        public ?int $scanTimeMs,
        public ?string $createdAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            scannedHost: $data['scanned_host'] ?? null,
            expectedOpenResults: $data['expected_open_results'] ?? [],
            expectedClosedResults: $data['expected_closed_results'] ?? [],
            issues: $data['issues'] ?? [],
            scanTimeMs: $data['scan_time_ms'] ?? null,
            createdAt: $data['created_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
