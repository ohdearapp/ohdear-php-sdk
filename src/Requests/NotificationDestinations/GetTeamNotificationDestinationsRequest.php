<?php

namespace OhDear\PhpSdk\Requests\NotificationDestinations;

use OhDear\PhpSdk\Dto\NotificationDestination;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetTeamNotificationDestinationsRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/team-notification-destinations';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return NotificationDestination::collect($response);
    }
}
