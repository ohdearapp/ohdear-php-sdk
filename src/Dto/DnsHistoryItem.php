<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class DnsHistoryItem
{
    public function __construct(
        public int $id,
        public array $authoritative_nameservers,
        public array $dns_records,
        public array $raw_dns_records,
        public mixed $issues,
        public string $diff_summary,
        public string $created_at,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            id: $data['id'],
            authoritative_nameservers: $data['authoritative_nameservers'] ?? [],
            dns_records: $data['dns_records'] ?? [],
            raw_dns_records: $data['raw_dns_records'] ?? [],
            issues: $data['issues'],
            diff_summary: $data['diff_summary'],
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
