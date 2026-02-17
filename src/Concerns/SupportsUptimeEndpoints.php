<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\Uptime;
use OhDear\PhpSdk\Enums\UptimeSplit;
use OhDear\PhpSdk\Requests\Uptime\GetUptimeRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsUptimeEndpoints
{
    /** @return list<Uptime> */
    public function uptime(int $monitorId, string $startedAt, string $endedAt, UptimeSplit $split = UptimeSplit::Hour): array
    {
        $request = new GetUptimeRequest($monitorId, $startedAt, $endedAt, $split);

        return $this->send($request)->dtoOrFail();
    }
}
