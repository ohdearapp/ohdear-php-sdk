<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class ApplicationHealthCheckHistoryItem
{
    public function __construct(
        public int $id,
        public string $status,
        public string $shortSummary,
        public ?string $message,
        public ?array $meta,
        public string $detectedAt,
        public string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            status: $data['status'],
            shortSummary: $data['short_summary'],
            message: $data['message'] ?? null,
            meta: $data['meta'] ?? null,
            detectedAt: $data['detected_at'],
            updatedAt: $data['updated_at'],
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
