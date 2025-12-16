<?php

namespace OhDear\PhpSdk\Dto;

class BrokenLink
{
    public function __construct(
        public ?int $statusCode,
        public string $crawledUrl,
        public string $relativeCrawledUrl,
        public string $foundOnUrl,
        public string $relativeFoundOnUrl,
        public string $linkText,
        public bool $internal,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            statusCode: $data['status_code'],
            crawledUrl: $data['crawled_url'],
            relativeCrawledUrl: $data['relative_crawled_url'],
            foundOnUrl: $data['found_on_url'],
            relativeFoundOnUrl: $data['relative_found_on_url'],
            linkText: $data['link_text'],
            internal: $data['internal'],
        );
    }

    /** @return array<int, BrokenLink> */
    public static function collect(array $data): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $data);
    }
}
