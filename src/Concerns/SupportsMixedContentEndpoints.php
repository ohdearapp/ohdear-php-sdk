<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Requests\MixedContent\GetMixedContentRequest;

trait SupportsMixedContentEndpoints
{
    public function mixedContent(int $monitorId): array
    {
        $request = new GetMixedContentRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }
}
