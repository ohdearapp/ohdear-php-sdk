<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class DetectedCertificate
{
    public function __construct(
        public int $id,
        public int $monitor_id,
        public string $fingerprint,
        public ?array $certificate_details,
        public string $created_at,
        public string $updated_at,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new static(
            id: $data['id'],
            monitor_id: $data['monitor_id'],
            fingerprint: $data['fingerprint'],
            certificate_details: $data['certificate_details'],
            created_at: $data['created_at'],
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