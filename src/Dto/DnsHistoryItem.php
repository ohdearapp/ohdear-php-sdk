<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class DnsHistoryItem
{
    public function __construct(
        public int $id,
        public array $authoritativeNameservers,
        public array $dnsRecords,
        public array $rawDnsRecords,
        public mixed $issues,
        public string $diffSummary,
        public string $createdAt,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            id: $data['id'],
            authoritativeNameservers: $data['authoritative_nameservers'] ?? [],
            dnsRecords: $data['dns_records'] ?? [],
            rawDnsRecords: $data['raw_dns_records'] ?? [],
            issues: $data['issues'],
            diffSummary: $data['diff_summary'],
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
