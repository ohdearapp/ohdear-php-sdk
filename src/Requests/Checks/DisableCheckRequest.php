<?php

namespace OhDear\PhpSdk\Requests\Checks;

use OhDear\PhpSdk\Dto\Check;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class DisableCheckRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected int $checkId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/checks/{$this->checkId}/disable";
    }

    public function createDtoFromResponse(Response $response): Check
    {
        return Check::fromResponse($response->json());
    }
}