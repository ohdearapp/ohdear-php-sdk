<?php

namespace OhDear\PhpSdk\Dto;

class DnsBlocklistHistoryItem
{
    public function __construct(
        public int $id,
        public ?string $checkedDomain,
        public array $resolvedIps,
        public array $blocklistResults,
        public mixed $issues,
        public ?string $createdAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            checkedDomain: $data['checked_domain'] ?? null,
            resolvedIps: $data['resolved_ips'] ?? [],
            blocklistResults: $data['blocklist_results'] ?? [],
            issues: $data['issues'] ?? null,
            createdAt: $data['created_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
