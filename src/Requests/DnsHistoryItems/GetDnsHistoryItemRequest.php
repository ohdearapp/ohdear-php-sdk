<?php

namespace OhDear\PhpSdk\Requests\DnsHistoryItems;

use OhDear\PhpSdk\Dto\DnsHistoryItem;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetDnsHistoryItemRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected int $dnsHistoryItemId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/dns-history-items/{$this->dnsHistoryItemId}";
    }

    public function createDtoFromResponse(Response $response): DnsHistoryItem
    {
        return DnsHistoryItem::fromResponse($response->json());
    }
}
