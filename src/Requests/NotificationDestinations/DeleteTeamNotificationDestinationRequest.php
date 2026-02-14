<?php

namespace OhDear\PhpSdk\Requests\NotificationDestinations;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteTeamNotificationDestinationRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $teamId,
        protected int $destinationId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/team-notification-destinations/{$this->teamId}/destination/{$this->destinationId}";
    }
}
