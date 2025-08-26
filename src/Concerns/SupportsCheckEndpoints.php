<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\Check;
use OhDear\PhpSdk\Requests\Checks\DisableCheckRequest;
use OhDear\PhpSdk\Requests\Checks\EnableCheckRequest;
use OhDear\PhpSdk\Requests\Checks\RequestCheckRunRequest;
use OhDear\PhpSdk\Requests\Checks\SnoozeCheckRequest;
use OhDear\PhpSdk\Requests\Checks\UnsnoozeCheckRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsCheckEndpoints
{
    public function enableCheck(int $checkId): Check
    {
        $request = new EnableCheckRequest($checkId);

        return $this->send($request)->dto();
    }

    public function disableCheck(int $checkId): Check
    {
        $request = new DisableCheckRequest($checkId);

        return $this->send($request)->dto();
    }

    public function requestCheckRun(int $checkId, array $httpClientHeaders = []): Check
    {
        $request = new RequestCheckRunRequest($checkId, $httpClientHeaders);

        return $this->send($request)->dto();
    }

    public function snoozeCheck(int $checkId, int $minutes): Check
    {
        $request = new SnoozeCheckRequest($checkId, $minutes);

        return $this->send($request)->dto();
    }

    public function unsnoozeCheck(int $checkId): Check
    {
        $request = new UnsnoozeCheckRequest($checkId);

        return $this->send($request)->dto();
    }
}
