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
        public ?int $frequency_in_minutes,
        public ?int $grace_time_in_minutes,
        public ?string $cron_expression,
        public string $human_readable_cron_expression,
        public ?string $server_timezone,
        public string $ping_url,
        public string $created_at,
        public string $latest_result,
        public string $latest_result_label,
        public string $latest_result_label_color,
        public ?string $latest_ping_at,
        public string $human_readable_latest_ping_at,
        public ?array $active_snooze,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            uuid: $data['uuid'],
            name: $data['name'],
            type: $data['type'],
            description: $data['description'] ?? null,
            frequency_in_minutes: $data['frequency_in_minutes'] ?? null,
            grace_time_in_minutes: $data['grace_time_in_minutes'] ?? null,
            cron_expression: $data['cron_expression'] ?? null,
            human_readable_cron_expression: $data['human_readable_cron_expression'] ?? '',
            server_timezone: $data['server_timezone'] ?? null,
            ping_url: $data['ping_url'],
            created_at: $data['created_at'],
            latest_result: $data['latest_result'] ?? '',
            latest_result_label: $data['latest_result_label'] ?? '',
            latest_result_label_color: $data['latest_result_label_color'] ?? '',
            latest_ping_at: $data['latest_ping_at'] ?? null,
            human_readable_latest_ping_at: $data['human_readable_latest_ping_at'] ?? '',
            active_snooze: $data['active_snooze'] ?? null,
        );
    }

    /** @return array<int, CronCheckDefinition> */
    public static function collect(array $data): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $data);
    }
}
