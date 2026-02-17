<?php

namespace OhDear\PhpSdk\Dto;

class StatusPageUpdateTemplate
{
    public function __construct(
        public int $id,
        public ?int $teamId,
        public string $name,
        public ?string $title,
        public ?string $text,
        public ?string $severity,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            teamId: $data['team_id'] ?? null,
            name: $data['name'],
            title: $data['title'] ?? null,
            text: $data['text'] ?? null,
            severity: $data['severity'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
