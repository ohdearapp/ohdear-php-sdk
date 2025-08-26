<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\Sitemap;
use OhDear\PhpSdk\Requests\Sitemap\GetSitemapRequest;

trait SupportsSitemapEndpoints
{
    public function sitemap(int $monitorId): Sitemap
    {
        $request = new GetSitemapRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }
}
