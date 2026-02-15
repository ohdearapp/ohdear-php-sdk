<?php

namespace OhDear\PhpSdk\Requests\Monitors;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AddToBrokenLinksWhitelistRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int $monitorId,
        protected string $url,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/add-to-broken-links-whitelist";
    }

    protected function defaultBody(): array
    {
        return [
            'whitelistUrl' => $this->url,
        ];
    }
}
