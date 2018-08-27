<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\MixedContentItem;

trait ManagesMixedContent
{
    public function mixedContent(int $siteId): array
    {
        return $this->transformCollection(
            $this->get("mixed-content-item/$siteId")['data'],
            MixedContentItem::class
        );
    }
}
