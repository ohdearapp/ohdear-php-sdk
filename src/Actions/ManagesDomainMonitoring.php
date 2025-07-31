<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Domain;

trait ManagesDomainMonitoring
{
    public function domain(int $monitorId): Domain
    {
        return new Domain(
            $this->get("monitors/{$monitorId}/domain"),
            $this
        );
    }
}
