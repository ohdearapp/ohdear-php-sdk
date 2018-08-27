<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\BrokenLink;

trait ManagesBrokenLinks
{
    public function mixedContent(int $siteId): array
    {
        return $this->transformCollection(
            $this->get("broken-links/$siteId")['data'],
            BrokenLink::class
        );
    }
}
