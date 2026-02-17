<?php

namespace OhDear\PhpSdk\Requests\Monitors;

use OhDear\PhpSdk\Dto\NotificationDestination;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateNotificationDestinationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $monitorId,
        protected int $destinationId,
        protected array $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/notification-destinations/{$this->destinationId}";
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
