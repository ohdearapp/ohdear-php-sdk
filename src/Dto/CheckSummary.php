<?php

namespace OhDear\PhpSdk\Dto;

use OhDear\PhpSdk\Enums\CheckResult;

class CheckSummary
{
    public function __construct(
        public string $result,
        public ?string $summary,
    ) {}

    public function checkResult(): ?CheckResult
    {
        return CheckResult::tryFrom($this->result);
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            result: $data['result'],
            summary: $data['summary'] ?? null,
        );
    }
}
