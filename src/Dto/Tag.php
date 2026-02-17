<?php

namespace OhDear\PhpSdk\Dto;

class Tag
{
    public function __construct(
        public int $id,
        public ?int $teamId,
        public ?string $teamName,
        public string $name,
        public ?string $slug,
        public array $sites,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            teamId: $data['team_id'] ?? null,
            teamName: $data['team_name'] ?? null,
            name: $data['name'],
            slug: $data['slug'] ?? null,
            sites: $data['sites'] ?? [],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
