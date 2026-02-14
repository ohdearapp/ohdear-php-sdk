<?php

namespace OhDear\PhpSdk\Requests\PortsHistoryItems;

use OhDear\PhpSdk\Dto\PortsHistoryItem;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetPortsHistoryItemRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected int $portsHistoryItemId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/ports-history-items/{$this->portsHistoryItemId}";
    }

    public function createDtoFromResponse(Response $response): PortsHistoryItem
    {
        return PortsHistoryItem::fromResponse($response->json());
    }
}
