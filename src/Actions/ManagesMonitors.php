<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\CheckSummary;
use OhDear\PhpSdk\Resources\Monitor;

trait ManagesMonitors
{
    public function monitors(): array
    {
        return $this->transformCollection(
            $this->get('monitors')['data'],
            Monitor::class,
        );
    }

    public function monitor(int $monitorId): Monitor
    {
        $siteAttributes = $this->get("monitors/{$monitorId}");

        return new Monitor($siteAttributes, $this);
    }

    public function checkSummary(int $monitorId, string $checkType): CheckSummary
    {
        $checkSummaryAttributes = $this->get("monitors/{$monitorId}/check-summary/{$checkType}");

        return new CheckSummary($checkSummaryAttributes, $this);
    }

    public function monitorByUrl(string $siteUrl): Monitor
    {
        $siteAttributes = $this->get("monitors/url/{$siteUrl}");

        return new Monitor($siteAttributes, $this);
    }

    /**
     * @link https://ohdear.app/docs/integrations/the-oh-dear-api#add-a-site-with-custom-settings
     */
    public function createMonitor(array $data): Monitor
    {
        $siteAttributes = $this->post('monitors', $data);

        return new Monitor($siteAttributes, $this);
    }

    /**
     * @link https://ohdear.app/docs/integrations/the-oh-dear-api#updating-site-settings
     */
    public function updateSite(int $monitorId, array $data): Monitor
    {
        $siteAttributes = $this->put("monitors/{$monitorId}", $data);

        return new Monitor($siteAttributes, $this);
    }

    public function deleteMonitor(int $monitorId)
    {
        $this->delete("monitors/$monitorId");
    }
}
