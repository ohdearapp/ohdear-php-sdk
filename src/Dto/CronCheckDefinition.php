<?php

namespace OhDear\PhpSdk\Dto;

class CronCheckDefinition
{
    public function __construct(
        public int $id,
        public string $uuid,
        public string $name,
        public string $type,
        public ?string $description,
        public ?int $frequencyInMinutes,
        public ?int $graceTimeInMinutes,
        public ?string $cronExpression,
        public string $humanReadableCronExpression,
        public ?string $serverTimezone,
        public string $pingUrl,
        public string $createdAt,
        public string $latestResult,
        public string $latestResultLabel,
        public string $latestResultLabelColor,
        public ?string $latestPingAt,
        public string $humanReadableLatestPingAt,
        public ?array $activeSnooze,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            uuid: $data['uuid'],
            name: $data['name'],
            type: $data['type'],
            description: $data['description'] ?? null,
            frequencyInMinutes: $data['frequency_in_minutes'] ?? null,
            graceTimeInMinutes: $data['grace_time_in_minutes'] ?? null,
            cronExpression: $data['cron_expression'] ?? null,
            humanReadableCronExpression: $data['human_readable_cron_expression'] ?? '',
            serverTimezone: $data['server_timezone'] ?? null,
            pingUrl: $data['ping_url'],
            createdAt: $data['created_at'],
            latestResult: $data['latest_result'] ?? '',
            latestResultLabel: $data['latest_result_label'] ?? '',
            latestResultLabelColor: $data['latest_result_label_color'] ?? '',
            latestPingAt: $data['latest_ping_at'] ?? null,
            humanReadableLatestPingAt: $data['human_readable_latest_ping_at'] ?? '',
            activeSnooze: $data['active_snooze'] ?? null,
        );
    }

    /** @return array<int, CronCheckDefinition> */
    public static function collect(array $data): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $data);
    }
}
