<?php

namespace OhDear\PhpSdk\Requests\Monitors;

use OhDear\PhpSdk\Dto\NotificationDestination;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetNotificationDestinationsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/notification-destinations";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return NotificationDestination::collect($response);
    }
}
