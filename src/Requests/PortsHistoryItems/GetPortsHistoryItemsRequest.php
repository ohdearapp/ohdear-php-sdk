<?php

namespace OhDear\PhpSdk\Requests\PortsHistoryItems;

use OhDear\PhpSdk\Dto\PortsHistoryItem;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetPortsHistoryItemsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/ports-history-items";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return PortsHistoryItem::collect($response->json('data'));
    }
}
