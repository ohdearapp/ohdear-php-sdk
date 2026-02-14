<?php

namespace OhDear\PhpSdk\Dto;

class DomainInfo
{
    public function __construct(
        public ?string $expiresAt,
        public ?string $registeredAt,
        public ?string $lastChangedAt,
        public ?string $lastUpdatedInRdapDbAt,
        public array $domainStatuses,
        public array $rdapDomainResponse,
        public ?string $createdAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            expiresAt: $data['expires_at'] ?? null,
            registeredAt: $data['registered_at'] ?? null,
            lastChangedAt: $data['last_changed_at'] ?? null,
            lastUpdatedInRdapDbAt: $data['last_updated_in_rdap_db_at'] ?? null,
            domainStatuses: $data['domain_statuses'] ?? [],
            rdapDomainResponse: $data['rdap_domain_response'] ?? [],
            createdAt: $data['created_at'] ?? null,
        );
    }
}
