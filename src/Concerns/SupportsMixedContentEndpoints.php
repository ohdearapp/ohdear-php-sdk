<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Requests\MixedContent\GetMixedContentRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsMixedContentEndpoints
{
    public function mixedContent(int $monitorId): array
    {
        $request = new GetMixedContentRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }
}
