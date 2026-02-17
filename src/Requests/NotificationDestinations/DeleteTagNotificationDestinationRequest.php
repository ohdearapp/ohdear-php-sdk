<?php

namespace OhDear\PhpSdk\Requests\NotificationDestinations;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteTagNotificationDestinationRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $tagId,
        protected int $destinationId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/tags/{$this->tagId}/notification-destinations/destination/{$this->destinationId}";
    }
}
