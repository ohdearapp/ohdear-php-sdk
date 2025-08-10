<?php

namespace OhDear\PhpSdk\Dto;

class BrokenLink
{
    public function __construct(
        public int $status_code,
        public string $crawled_url,
        public string $relative_crawled_url,
        public string $found_on_url,
        public string $relative_found_on_url,
        public string $link_text,
        public bool $internal,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            status_code: $data['status_code'],
            crawled_url: $data['crawled_url'],
            relative_crawled_url: $data['relative_crawled_url'],
            found_on_url: $data['found_on_url'],
            relative_found_on_url: $data['relative_found_on_url'],
            link_text: $data['link_text'],
            internal: $data['internal'],
        );
    }

    /** @return array<int, BrokenLink> */
    public static function collect(array $data): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $data);
    }
}
