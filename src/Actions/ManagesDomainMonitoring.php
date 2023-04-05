<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Domain;

trait ManagesDomainMonitoring
{
    public function domain(int $siteId): Domain
    {
        return new Domain(
            $this->get("sites/{$siteId}/domain"),
            $this
        );
    }
}
