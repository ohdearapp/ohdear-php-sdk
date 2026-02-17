<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteStatusPageMonitorRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $statusPageId,
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/status-pages/{$this->statusPageId}/monitors/{$this->monitorId}";
    }
}
