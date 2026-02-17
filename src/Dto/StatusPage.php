<?php

namespace OhDear\PhpSdk\Dto;

class StatusPage
{
    public function __construct(
        public int $id,
        public ?array $team,
        public ?string $title,
        public ?string $domain,
        public ?string $secret,
        public ?string $badgeId,
        public ?string $slug,
        public ?string $fullUrl,
        public ?string $timezone,
        public ?string $summarizedStatus,
        public ?array $updates,
        public ?array $monitors,
        public bool $preventIndexing = false,
        public bool $addHstsHeader = false,
        public string $createdAt = '',
        public string $updatedAt = '',
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            team: $data['team'] ?? null,
            title: $data['title'] ?? null,
            domain: $data['domain'] ?? null,
            secret: $data['secret'] ?? null,
            badgeId: $data['badge_id'] ?? null,
            slug: $data['slug'] ?? null,
            fullUrl: $data['full_url'] ?? null,
            timezone: $data['timezone'] ?? null,
            summarizedStatus: $data['summarized_status'] ?? null,
            updates: $data['updates'] ?? [],
            monitors: $data['monitors'] ?? [],
            preventIndexing: $data['prevent_indexing'] ?? false,
            addHstsHeader: $data['add_hsts_header'] ?? false,
            createdAt: $data['created_at'] ?? '',
            updatedAt: $data['updated_at'] ?? '',
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
