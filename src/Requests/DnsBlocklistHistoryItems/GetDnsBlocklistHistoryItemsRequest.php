<?php

namespace OhDear\PhpSdk\Requests\DnsBlocklistHistoryItems;

use OhDear\PhpSdk\Dto\DnsBlocklistHistoryItem;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetDnsBlocklistHistoryItemsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/dns-blocklist-history-items";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return DnsBlocklistHistoryItem::collect($response->json('data'));
    }
}
