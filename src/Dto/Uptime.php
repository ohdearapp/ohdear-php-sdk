<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class Uptime
{
    public function __construct(
        public string $datetime,
        public float $uptimePercentage,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            datetime: $data['datetime'],
            uptimePercentage: $data['uptime_percentage'],
        );
    }

    public static function collect(Response $response): array
    {
        return array_map(
            fn (array $item) => self::fromResponse($item),
            $response->json()
        );
    }
}
