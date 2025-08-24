<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class DowntimePeriod
{
    public function __construct(
        public int $id,
        public string $startedAt,
        public ?string $endedAt,
        public ?string $notesHtml,
        public ?string $notesMarkdown,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            startedAt: $data['started_at'],
            endedAt: $data['ended_at'],
            notesHtml: $data['notes_html'],
            notesMarkdown: $data['notes_markdown'],
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
