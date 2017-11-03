<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\Check;

trait ManagesChecks
{
    public function enableCheck(int $checkId): Check
    {
        $checkAttributes = $this->post("/checks/{$checkId}/enable");

        return new Check($checkAttributes, $this);
    }

    public function disableCheck(int $checkId): Check
    {
        $checkAttributes = $this->post("/checks/{$checkId}/disable");

        return new Check($checkAttributes, $this);
    }

    public function requestRun(int $checkId): Check
    {
        $checkAttributes = $this->post("/checks/{$checkId}/request-run");

        return new Check($checkAttributes, $this);
    }
}