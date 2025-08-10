<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class ApplicationHealthCheckHistoryItem
{
    public function __construct(
        public int $id,
        public string $status,
        public string $short_summary,
        public ?string $message,
        public ?array $meta,
        public string $detected_at,
        public string $updated_at,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            id: $data['id'],
            status: $data['status'],
            short_summary: $data['short_summary'],
            message: $data['message'],
            meta: $data['meta'],
            detected_at: $data['detected_at'],
            updated_at: $data['updated_at'],
        );
    }

    public static function collect(Response $response): array
    {
        return array_map(
            fn (array $item) => self::fromResponse($item),
            $response->json('data')
        );
    }
}
