<?php

namespace OhDear\PhpSdk\Dto;

class ManagedTeam
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $timezone,
        public ?string $createdAt,
        public ?int $monitorsCount,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            timezone: $data['timezone'] ?? null,
            createdAt: $data['created_at'] ?? null,
            monitorsCount: $data['monitors_count'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
