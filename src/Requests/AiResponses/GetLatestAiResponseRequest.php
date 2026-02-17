<?php

namespace OhDear\PhpSdk\Requests\AiResponses;

use OhDear\PhpSdk\Dto\AiResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetLatestAiResponseRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/ai-responses/latest";
    }

    public function createDtoFromResponse(Response $response): AiResponse
    {
        return AiResponse::fromResponse($response->json());
    }
}
