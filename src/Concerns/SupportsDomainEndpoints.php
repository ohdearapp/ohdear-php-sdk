<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\DomainInfo;
use OhDear\PhpSdk\Requests\Domain\GetDomainRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsDomainEndpoints
{
    public function domain(int $monitorId): DomainInfo
    {
        $request = new GetDomainRequest($monitorId);

        return $this->send($request)->dto();
    }
}
