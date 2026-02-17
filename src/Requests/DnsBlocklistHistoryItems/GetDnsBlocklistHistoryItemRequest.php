<?php

namespace OhDear\PhpSdk\Requests\DnsBlocklistHistoryItems;

use OhDear\PhpSdk\Dto\DnsBlocklistHistoryItem;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetDnsBlocklistHistoryItemRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected int $dnsBlocklistHistoryItemId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/dns-blocklist-history-items/{$this->dnsBlocklistHistoryItemId}";
    }

    public function createDtoFromResponse(Response $response): DnsBlocklistHistoryItem
    {
        return DnsBlocklistHistoryItem::fromResponse($response->json());
    }
}
