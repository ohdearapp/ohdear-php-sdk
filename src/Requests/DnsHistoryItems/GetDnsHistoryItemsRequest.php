<?php

namespace OhDear\PhpSdk\Requests\DnsHistoryItems;

use OhDear\PhpSdk\Dto\DnsHistoryItem;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetDnsHistoryItemsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/dns-history-items";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return DnsHistoryItem::collect($response);
    }
}
