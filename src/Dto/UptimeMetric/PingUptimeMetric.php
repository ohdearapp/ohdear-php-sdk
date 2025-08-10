<?php

namespace OhDear\PhpSdk\Dto\UptimeMetric;

class PingUptimeMetric
{
    public function __construct(
        public float $minimumTimeInMs,
        public float $maximumTimeInMs,
        public float $averageTimeInMs,
        public float $packetLossPercentage,
        public float $uptimePercentage,
        public float $downtimePercentage,
        public int $uptimeSeconds,
        public int $downtimeSeconds,
        public string $date,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            minimumTimeInMs: $data['minimum_time_in_ms'],
            maximumTimeInMs: $data['maximum_time_in_ms'],
            averageTimeInMs: $data['average_time_in_ms'],
            packetLossPercentage: $data['packet_loss_percentage'],
            uptimePercentage: $data['uptime_percentage'],
            downtimePercentage: $data['downtime_percentage'],
            uptimeSeconds: $data['uptime_seconds'],
            downtimeSeconds: $data['downtime_seconds'],
            date: $data['date'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
