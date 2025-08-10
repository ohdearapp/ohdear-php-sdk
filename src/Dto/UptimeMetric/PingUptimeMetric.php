<?php

namespace OhDear\PhpSdk\Dto\UptimeMetric;

class PingUptimeMetric
{
    public function __construct(
        public float $minimum_time_in_ms,
        public float $maximum_time_in_ms,
        public float $average_time_in_ms,
        public float $packet_loss_percentage,
        public float $uptime_percentage,
        public float $downtime_percentage,
        public int $uptime_seconds,
        public int $downtime_seconds,
        public string $date,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            minimum_time_in_ms: $data['minimum_time_in_ms'],
            maximum_time_in_ms: $data['maximum_time_in_ms'],
            average_time_in_ms: $data['average_time_in_ms'],
            packet_loss_percentage: $data['packet_loss_percentage'],
            uptime_percentage: $data['uptime_percentage'],
            downtime_percentage: $data['downtime_percentage'],
            uptime_seconds: $data['uptime_seconds'],
            downtime_seconds: $data['downtime_seconds'],
            date: $data['date'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
