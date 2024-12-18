<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\CheckSummary;
use OhDear\PhpSdk\Resources\Site;

trait ManagesSites
{
    public function sites(): array
    {
        return $this->transformCollection(
            $this->get('sites')['data'],
            Site::class,
        );
    }

    public function site(int $siteId): Site
    {
        $siteAttributes = $this->get("sites/{$siteId}");

        return new Site($siteAttributes, $this);
    }

    public function checkSummary(int $siteId, string $checkType): CheckSummary
    {
        $checkSummaryAttributes = $this->get("sites/{$siteId}/check-summary/{$checkType}");

        return new CheckSummary($checkSummaryAttributes, $this);
    }

    public function siteByUrl(string $siteUrl): Site
    {
        $siteAttributes = $this->get("sites/url/{$siteUrl}");

        return new Site($siteAttributes, $this);
    }

    /**
     * @link https://ohdear.app/docs/integrations/the-oh-dear-api#add-a-site-with-custom-settings
     */
    public function createSite(array $data): Site
    {
        $siteAttributes = $this->post('sites', $data);

        return new Site($siteAttributes, $this);
    }

    /**
     * @link https://ohdear.app/docs/integrations/the-oh-dear-api#updating-site-settings
     */
    public function updateSite(int $siteId, array $data): Site
    {
        $siteAttributes = $this->put("sites/{$siteId}", $data);

        return new Site($siteAttributes, $this);
    }

    public function deleteSite(int $siteId)
    {
        $this->delete("sites/$siteId");
    }
}
