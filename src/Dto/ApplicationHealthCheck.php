<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class ApplicationHealthCheck
{
    public function __construct(
        public int $id,
        public string $name,
        public string $label,
        public ?string $status,
        public ?string $message,
        public array $meta,
        public ?string $shortSummary,
        public ?string $detectedAt,
        public ?string $updatedAt,
        public ?array $activeSnooze,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            label: $data['label'],
            status: $data['status'] ?? null,
            message: $data['message'] ?? null,
            meta: $data['meta'] ?? [],
            shortSummary: $data['short_summary'] ?? null,
            detectedAt: $data['detected_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            activeSnooze: $data['active_snooze'] ?? null,
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
