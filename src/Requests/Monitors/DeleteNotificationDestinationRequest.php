<?php

namespace OhDear\PhpSdk\Requests\Monitors;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteNotificationDestinationRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $monitorId,
        protected int $destinationId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/notification-destinations/{$this->destinationId}";
    }
}
