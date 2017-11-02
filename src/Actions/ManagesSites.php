<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Site;

trait ManagesSites
{
    public function sites(): array
    {
        return $this->transformCollection(
            $this->get("sites")['data'],
            Site::class
        );
    }

    public function createSite(array $data): Site
    {
        $site = $this->post("sites", $data);

        return new Site($site);
    }

    public function deleteSite(int $siteId)
    {
        $this->delete("sites/$siteId");
    }
}