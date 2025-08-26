<?php

declare(strict_types=1);

namespace OhDear\PhpSdk\Dto;

class StatusPageUpdate
{
    public function __construct(
        public int $id,
        public string $title,
        public string $text,
        public bool $pinned,
        public string $severity,
        public string $time,
        public string $statusPageUrl,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            text: $data['text'],
            pinned: $data['pinned'],
            severity: $data['severity'],
            time: $data['time'],
            statusPageUrl: $data['status_page_url'],
        );
    }
}
