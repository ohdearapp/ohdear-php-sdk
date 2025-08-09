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
        public ?string $badge_id,
        public ?string $slug,
        public ?string $full_url,
        public ?string $timezone,
        public ?string $summarized_status,
        public ?array $updates,
        public ?array $monitors,
        public string $created_at,
        public string $updated_at,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            team: $data['team'] ?? null,
            title: $data['title'],
            domain: $data['domain'] ?? null,
            secret: $data['secret'] ?? null,
            badge_id: $data['badge_id'] ?? null,
            slug: $data['slug'] ?? null,
            full_url: $data['full_url'] ?? null,
            timezone: $data['timezone'] ?? null,
            summarized_status: $data['summarized_status'] ?? null,
            updates: $data['updates'] ?? [],
            monitors: $data['monitors'] ?? [],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
