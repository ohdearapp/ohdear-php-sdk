<?php

namespace OhDear\PhpSdk\Dto;

class Monitor
{
    public function __construct(
        public int $id,
        public ?int $teamId,
        public string $type,
        public string $url,
        public bool $usesHttps,
        public string $sortUrl,
        public ?string $label = null,
        public string $groupName = '',
        public array $tags = [],
        public ?string $description = null,
        public ?string $notes = null,
        public ?string $latestRunDate = null,
        public ?string $summarizedCheckResult = null,
        public array $checks = [],
        public array $uptimeCheckSettings = [],
        public array $certificateHealthCheckSettings = [],
        public array $brokenLinksCheckSettings = [],
        public array $dnsCheckSettings = [],
        public array $lighthouseCheckSettings = [],
        public array $applicationHealthCheckSettings = [],
        public array $domainCheckSettings = [],
        public array $performanceCheckSettings = [],
        public array $sitemapCheckSettings = [],
        public ?array $portsCheckSettings = null,
        public ?array $dnsBlocklistCheckSettings = null,
        public ?array $aiCheckSettings = null,
        public array $crawlerHeaders = [],
        public array $sendReportToEmails = [],
        public array $includeCheckTypesInReport = [],
        public ?string $badgeId = null,
        public ?string $markedForDeletionAt = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            teamId: $data['team_id'],
            type: $data['type'] ?? 'http',
            url: $data['url'],
            usesHttps: $data['uses_https'] ?? false,
            sortUrl: $data['sort_url'] ?? $data['url'],
            label: $data['label'] ?? null,
            groupName: $data['group_name'] ?? '',
            tags: $data['tags'] ?? [],
            description: $data['description'] ?? null,
            notes: $data['notes'] ?? null,
            latestRunDate: $data['latest_run_date'] ?? null,
            summarizedCheckResult: $data['summarized_check_result'] ?? null,
            checks: $data['checks'] ?? [],
            uptimeCheckSettings: $data['uptime_check_settings'] ?? [],
            certificateHealthCheckSettings: $data['certificate_health_check_settings'] ?? [],
            brokenLinksCheckSettings: $data['broken_links_check_settings'] ?? [],
            dnsCheckSettings: $data['dns_check_settings'] ?? [],
            lighthouseCheckSettings: $data['lighthouse_check_settings'] ?? [],
            applicationHealthCheckSettings: $data['application_health_check_settings'] ?? [],
            domainCheckSettings: $data['domain_check_settings'] ?? [],
            performanceCheckSettings: $data['performance_check_settings'] ?? [],
            sitemapCheckSettings: $data['sitemap_check_settings'] ?? [],
            portsCheckSettings: $data['ports_check_settings'] ?? null,
            dnsBlocklistCheckSettings: $data['dns_blocklist_check_settings'] ?? null,
            aiCheckSettings: $data['ai_check_settings'] ?? null,
            crawlerHeaders: $data['crawler_headers'] ?? [],
            sendReportToEmails: $data['send_report_to_emails'] ?? [],
            includeCheckTypesInReport: $data['include_check_types_in_report'] ?? [],
            badgeId: $data['badge_id'] ?? null,
            markedForDeletionAt: $data['marked_for_deletion_at'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
