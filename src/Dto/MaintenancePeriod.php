<?php

namespace OhDear\PhpSdk\Dto;

class MaintenancePeriod
{
    public function __construct(
        public int $id,
        public int $monitor_id,
        public ?string $name,
        public string $starts_at,
        public string $ends_at,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            monitor_id: $data['monitor_id'],
            name: $data['name'] ?? null,
            starts_at: $data['starts_at'],
            ends_at: $data['ends_at'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}