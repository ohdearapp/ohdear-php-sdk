<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class DowntimePeriod
{
    public function __construct(
        public int $id,
        public string $started_at,
        public ?string $ended_at,
        public ?string $notes_html,
        public ?string $notes_markdown,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            id: $data['id'],
            started_at: $data['started_at'],
            ended_at: $data['ended_at'],
            notes_html: $data['notes_html'],
            notes_markdown: $data['notes_markdown'],
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
