<?php

namespace OhDear\PhpSdk\Resources;

class Site extends ApiResource
{
    public int $id;

    public string $url;

    /**
     * The checks of a site.
     *
     * @var Check[]
     */
    public array $checks;

    public string $sortUrl;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);

        $this->checks = array_map(function (array $checkAttributes) use ($ohDear) {
            return new Check($checkAttributes, $ohDear);
        }, $this->checks);
    }

    public function delete(): void
    {
        $this->ohDear->deleteSite($this->id);
    }

    public function startMaintenance(int $stopMaintenanceAfterSeconds = 60 * 60): void
    {
        $this->ohDear->startSiteMaintenance($this->id, $stopMaintenanceAfterSeconds);
    }

    public function stopMaintenance(): void
    {
        $this->ohDear->stopSiteMaintenance($this->id);
    }

    public function brokenLinks(): array
    {
        return $this->ohDear->brokenLinks($this->id);
    }

    public function mixedContent(): array
    {
        return $this->ohDear->mixedContent($this->id);
    }

    /**
     * Get the uptime percentages for a site.
     *
     * @param string $startedAt  Must be in format Ymdhis
     * @param string $endedAt  Must be in format Ymdhis
     * @param string $split  Use hour, day or month
     *
     * @return array
     */
    public function uptime(string $startedAt, string $endedAt, string $split): array
    {
        return $this->ohDear->uptime($this->id, $startedAt, $endedAt, $split);
    }

    /**
     * Get the downtime periods for a site.
     *
     * @param string $startedAt  Must be in format Ymdhis
     * @param string $endedAt  Must be in format Ymdhis
     *
     * @return array
     */
    public function downtime(string $startedAt, string $endedAt): array
    {
        return $this->ohDear->downtime($this->id, $startedAt, $endedAt);
    }

    public function certificateHealth(): CertificateHealth
    {
        return $this->ohDear->certificateHealth($this->id);
    }

    public function cronChecks()
    {
        return $this->ohDear->cronChecks($this->id);
    }

    public function syncCronChecks(array $cronCheckAttributes): array
    {
        return $this->ohDear->syncCronChecks($this->id, $cronCheckAttributes);
    }

    public function performanceRecords(
        string $start,
        string $end,
        string $timeframe = '1m',
        string $sort = '-created_at'
    ) : array {
        return $this->ohDear->performanceRecords($this->id, $start, $end, $timeframe, $sort);
    }
}
