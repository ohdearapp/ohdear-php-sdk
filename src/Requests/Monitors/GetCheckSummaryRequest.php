<?php

namespace OhDear\PhpSdk\Requests\Monitors;

use OhDear\PhpSdk\Dto\CheckSummary;
use OhDear\PhpSdk\Enums\CheckType;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetCheckSummaryRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected CheckType $checkType,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/check-summary/{$this->checkType->value}";
    }

    public function createDtoFromResponse(Response $response): CheckSummary
    {
        return CheckSummary::fromResponse($response->json());
    }
}
