<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteStatusPageRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $statusPageId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/status-pages/{$this->statusPageId}";
    }
}
