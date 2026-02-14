<?php

namespace OhDear\PhpSdk\Dto;

class DnsBlocklistHistoryItem
{
    public function __construct(
        public int $id,
        public ?string $domain,
        public array $resolvedIps,
        public array $blocklists,
        public ?string $createdAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            domain: $data['domain'] ?? null,
            resolvedIps: $data['resolved_ips'] ?? [],
            blocklists: $data['blocklists'] ?? [],
            createdAt: $data['created_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
