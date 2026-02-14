<?php

namespace OhDear\PhpSdk\Dto;

class Tag
{
    public function __construct(
        public int $id,
        public ?int $teamId,
        public string $name,
        public array $monitors,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            teamId: $data['team_id'] ?? null,
            name: $data['name'],
            monitors: $data['monitors'] ?? [],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
