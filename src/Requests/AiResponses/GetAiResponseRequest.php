<?php

namespace OhDear\PhpSdk\Requests\AiResponses;

use OhDear\PhpSdk\Dto\AiResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetAiResponseRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected int $aiResponseId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/ai-responses/{$this->aiResponseId}";
    }

    public function createDtoFromResponse(Response $response): AiResponse
    {
        return AiResponse::fromResponse($response->json());
    }
}
