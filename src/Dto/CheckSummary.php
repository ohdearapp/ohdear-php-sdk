<?php

namespace OhDear\PhpSdk\Dto;

class CheckSummary
{
    public function __construct(
        public string $result,
        public ?string $summary,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            result: $data['result'],
            summary: $data['summary'],
        );
    }
}
