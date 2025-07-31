<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\MixedContentItem;

trait ManagesMixedContent
{
    public function mixedContent(int $monitorId): array
    {
        return $this->transformCollection(
            $this->get("mixed-content/$monitorId")['data'],
            MixedContentItem::class
        );
    }
}
