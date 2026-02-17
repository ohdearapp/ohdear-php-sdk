<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Requests\Downtime\DeleteDowntimePeriodRequest;
use OhDear\PhpSdk\Requests\Downtime\GetDowntimeRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsDowntimeEndpoints
{
    public function downtime(int $monitorId, string $startedAt, string $endedAt): array
    {
        $request = new GetDowntimeRequest($monitorId, $startedAt, $endedAt);

        return $this->send($request)->dtoOrFail();
    }

    public function deleteDowntimePeriod(int $downtimePeriodId): void
    {
        $request = new DeleteDowntimePeriodRequest($downtimePeriodId);

        $this->send($request);
    }
}
