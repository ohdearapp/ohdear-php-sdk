<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class DetectedCertificate
{
    public function __construct(
        public int $id,
        public int $monitorId,
        public string $fingerprint,
        public ?array $certificateDetails,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            id: $data['id'],
            monitorId: $data['monitor_id'],
            fingerprint: $data['fingerprint'],
            certificateDetails: $data['certificate_details'],
            createdAt: $data['created_at'],
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
