<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\User;
use OhDear\PhpSdk\Requests\MeRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsMeEndpoint
{
    public function me(): User
    {
        $request = new MeRequest;

        return $this->send($request)->dto();
    }
}
