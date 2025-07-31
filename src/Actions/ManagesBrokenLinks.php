<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\BrokenLink;

trait ManagesBrokenLinks
{
    public function brokenLinks(int $monitorId): array
    {
        return $this->transformCollection(
            $this->get("broken-links/$monitorId")['data'],
            BrokenLink::class
        );
    }
}
