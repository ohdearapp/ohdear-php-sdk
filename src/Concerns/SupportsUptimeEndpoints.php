<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\Uptime;
use OhDear\PhpSdk\Requests\Uptime\GetUptimeRequest;

trait SupportsUptimeEndpoints
{
    /** @return list<Uptime> */
    public function uptime(int $monitorId, string $startedAt, string $endedAt): array
    {
        $request = new GetUptimeRequest($monitorId, $startedAt, $endedAt);

        return $this->send($request)->dtoOrFail();
    }
}
