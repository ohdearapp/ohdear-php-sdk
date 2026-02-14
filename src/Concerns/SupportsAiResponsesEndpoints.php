<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\AiResponse;
use OhDear\PhpSdk\Requests\AiResponses\GetAiResponseRequest;
use OhDear\PhpSdk\Requests\AiResponses\GetAiResponsesRequest;
use OhDear\PhpSdk\Requests\AiResponses\GetLatestAiResponseRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsAiResponsesEndpoints
{
    public function aiResponses(int $monitorId): array
    {
        $request = new GetAiResponsesRequest($monitorId);

        return $this->send($request)->dtoOrFail();
    }

    public function aiResponse(int $monitorId, int $aiResponseId): AiResponse
    {
        $request = new GetAiResponseRequest($monitorId, $aiResponseId);

        return $this->send($request)->dto();
    }

    public function latestAiResponse(int $monitorId): AiResponse
    {
        $request = new GetLatestAiResponseRequest($monitorId);

        return $this->send($request)->dto();
    }
}
