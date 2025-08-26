<?php

namespace OhDear\PhpSdk\Requests\Checks;

use OhDear\PhpSdk\Dto\Check;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class SnoozeCheckRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int $checkId,
        protected int $minutes
    ) {}

    public function resolveEndpoint(): string
    {
        return "/checks/{$this->checkId}/snooze";
    }

    protected function defaultBody(): array
    {
        return [
            'minutes' => $this->minutes,
        ];
    }

    public function createDtoFromResponse(Response $response): Check
    {
        return Check::fromResponse($response->json());
    }
}
