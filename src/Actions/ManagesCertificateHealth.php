<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Certificate;

trait ManagesCertificate
{
    public function certificateHealth(int $siteId)
    {
        return $this->transformCollection(
            $this->get("sites/$siteId/certificate_health"),
            Certificate::class
        );
    }
}