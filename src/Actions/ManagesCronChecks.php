<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\CronCheck;

trait ManagesCronChecks
{
    public function cronChecks(int $siteId)
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/cron-checks")['data'],
            CronCheck::class
        );
    }
}
