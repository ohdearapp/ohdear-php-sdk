<?php

namespace OhDear\PhpSdk\Dto\UptimeMetric;

class TcpUptimeMetric
{
    public function __construct(
        public float $timeToConnectInMs,
        public float $uptimePercentage,
        public float $downtimePercentage,
        public int $uptimeSeconds,
        public int $downtimeSeconds,
        public string $date,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            timeToConnectInMs: $data['time_to_connect_in_ms'],
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
