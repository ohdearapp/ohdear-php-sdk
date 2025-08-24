<?php

namespace OhDear\PhpSdk\Dto;

class MaintenancePeriod
{
    public function __construct(
        public int $id,
        public int $monitorId,
        public ?string $name,
        public string $startsAt,
        public string $endsAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            monitorId: $data['monitor_id'],
            name: $data['name'] ?? null,
            startsAt: $data['starts_at'],
            endsAt: $data['ends_at'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
