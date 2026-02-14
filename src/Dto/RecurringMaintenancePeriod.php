<?php

namespace OhDear\PhpSdk\Dto;

class RecurringMaintenancePeriod
{
    public function __construct(
        public int $id,
        public int $monitorId,
        public ?string $name,
        public ?string $recurrenceType,
        public ?string $startTime,
        public ?string $endTime,
        public array $daysOfWeek,
        public ?int $dayOfMonth,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            monitorId: $data['monitor_id'],
            name: $data['name'] ?? null,
            recurrenceType: $data['recurrence_type'] ?? null,
            startTime: $data['start_time'] ?? null,
            endTime: $data['end_time'] ?? null,
            daysOfWeek: $data['days_of_week'] ?? [],
            dayOfMonth: $data['day_of_month'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
