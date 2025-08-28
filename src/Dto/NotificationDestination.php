<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class NotificationDestination
{
    public function __construct(
        public int $id,
        public ?string $label,
        public string $channel,
        public array $destination,
        public array $notificationTypes,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            label: $data['label'] ?? null,
            channel: $data['channel'],
            destination: $data['destination'] ?? [],
            notificationTypes: $data['notification_types'] ?? []
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
