<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteStatusPageUpdateRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $statusPageUpdateId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/status-page-updates/{$this->statusPageUpdateId}";
    }
}
