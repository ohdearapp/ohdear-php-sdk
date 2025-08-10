<?php

namespace OhDear\PhpSdk\Dto\UptimeMetric;

class HttpUptimeMetric
{
    public function __construct(
        public float $dns_time_in_seconds,
        public float $tcp_time_in_seconds,
        public float $ssl_handshake_time_in_seconds,
        public float $remote_server_processing_time_in_seconds,
        public float $download_time_in_seconds,
        public float $total_time_in_seconds,
        public array $curl,
        public string $date,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            dns_time_in_seconds: $data['dns_time_in_seconds'],
            tcp_time_in_seconds: $data['tcp_time_in_seconds'],
            ssl_handshake_time_in_seconds: $data['ssl_handshake_time_in_seconds'],
            remote_server_processing_time_in_seconds: $data['remote_server_processing_time_in_seconds'],
            download_time_in_seconds: $data['download_time_in_seconds'],
            total_time_in_seconds: $data['total_time_in_seconds'],
            curl: $data['curl'] ?? [],
            date: $data['date'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
