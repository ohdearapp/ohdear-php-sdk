<?php

namespace OhDear\PhpSdk\Dto;

use OhDear\PhpSdk\Enums\CheckResult;

class Check
{
    public function __construct(
        public int $id,
        public string $type,
        public string $label,
        public bool $enabled,
        public ?string $latestRunEndedAt,
        public ?string $latestRunResult,
        public ?string $summary,
        public array $settings,
        public ?float $averageResponseTimeInMs,
        public ?array $activeSnooze,
    ) {}

    public function checkResult(): ?CheckResult
    {
        if ($this->latestRunResult === null) {
            return null;
        }

        return CheckResult::tryFrom($this->latestRunResult);
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            type: $data['type'],
            label: $data['label'] ?? '',
            enabled: $data['enabled'],
            latestRunEndedAt: $data['latest_run_ended_at'] ?? null,
            latestRunResult: $data['latest_run_result'] ?? null,
            summary: $data['summary'] ?? null,
            settings: $data['settings'] ?? [],
            averageResponseTimeInMs: $data['average_response_time_in_ms'] ?? null,
            activeSnooze: $data['active_snooze'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
