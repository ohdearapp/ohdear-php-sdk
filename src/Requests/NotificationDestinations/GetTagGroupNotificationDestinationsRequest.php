<?php

namespace OhDear\PhpSdk\Requests\NotificationDestinations;

use OhDear\PhpSdk\Dto\NotificationDestination;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetTagGroupNotificationDestinationsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $tagGroupId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/tag-groups/{$this->tagGroupId}/notification-destinations";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return NotificationDestination::collect($response);
    }
}
