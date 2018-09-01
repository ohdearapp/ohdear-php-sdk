<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Site;

trait ManagesSites
{
    public function sites(): array
    {
        return $this->transformCollection(
            $this->get('sites')['data'],
            Site::class
        );
    }

    public function site(int $siteId): Site
    {
        $siteAttributes = $this->get("sites/{$siteId}");

        return new Site($siteAttributes, $this);
    }

    public function siteByUrl(string $siteUrl): Site
    {
        $siteAttributes = $this->get("sites/url/{$siteUrl}");

        return new Site($siteAttributes, $this);
    }

    public function createSite(array $data): Site
    {
        $siteAttributes = $this->post('sites', $data);

        return new Site($siteAttributes, $this);
    }

    public function deleteSite(int $siteId)
    {
        $this->delete("sites/$siteId");
    }
}
