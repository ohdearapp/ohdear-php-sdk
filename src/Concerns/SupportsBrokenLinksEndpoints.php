<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\BrokenLink;
use OhDear\PhpSdk\Requests\BrokenLinks\GetBrokenLinksRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsBrokenLinksEndpoints
{
    /** @return iterable<int, BrokenLink> */
    public function brokenLinks(int $monitorId): iterable
    {
        $request = new GetBrokenLinksRequest($monitorId);

        /** @var iterable<int, BrokenLink> $items */
        $items = $this->paginate($request)->items();
        
        return $items;
    }
}
