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
        public ?string $short_summary,
        public ?string $detected_at,
        public ?string $updated_at,
        public ?array $active_snooze,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            label: $data['label'],
            status: $data['status'],
            message: $data['message'],
            meta: $data['meta'] ?? [],
            short_summary: $data['short_summary'],
            detected_at: $data['detected_at'],
            updated_at: $data['updated_at'],
            active_snooze: $data['active_snooze'],
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
