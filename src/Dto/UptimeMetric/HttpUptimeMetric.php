<?php

namespace OhDear\PhpSdk\Dto\UptimeMetric;

class HttpUptimeMetric
{
    public function __construct(
        public float $dnsTimeInSeconds,
        public float $tcpTimeInSeconds,
        public float $sslHandshakeTimeInSeconds,
        public float $remoteServerProcessingTimeInSeconds,
        public float $downloadTimeInSeconds,
        public float $totalTimeInSeconds,
        public array $curl,
        public string $date,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            dnsTimeInSeconds: $data['dns_time_in_seconds'],
            tcpTimeInSeconds: $data['tcp_time_in_seconds'],
            sslHandshakeTimeInSeconds: $data['ssl_handshake_time_in_seconds'],
            remoteServerProcessingTimeInSeconds: $data['remote_server_processing_time_in_seconds'],
            downloadTimeInSeconds: $data['download_time_in_seconds'],
            totalTimeInSeconds: $data['total_time_in_seconds'],
            curl: $data['curl'] ?? [],
            date: $data['date'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
