<?php

namespace OhDear\PhpSdk\Requests\NotificationDestinations;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteTagGroupNotificationDestinationRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $tagGroupId,
        protected int $destinationId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/tag-groups/{$this->tagGroupId}/notification-destinations/{$this->destinationId}";
    }
}
