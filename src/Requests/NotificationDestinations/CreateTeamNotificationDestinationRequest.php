<?php

namespace OhDear\PhpSdk\Requests\NotificationDestinations;

use OhDear\PhpSdk\Dto\NotificationDestination;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateTeamNotificationDestinationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int $teamId,
        protected array $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/team-notification-destinations/{$this->teamId}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): NotificationDestination
    {
        return NotificationDestination::fromResponse($response->json());
    }
}
