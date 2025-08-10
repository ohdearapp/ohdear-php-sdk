<?php

namespace OhDear\PhpSdk\Dto\UptimeMetric;

class TcpUptimeMetric
{
    public function __construct(
        public float $time_to_connect_in_ms,
        public float $uptime_percentage,
        public float $downtime_percentage,
        public int $uptime_seconds,
        public int $downtime_seconds,
        public string $date,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            time_to_connect_in_ms: $data['time_to_connect_in_ms'],
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
