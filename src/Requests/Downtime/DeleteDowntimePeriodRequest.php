<?php

namespace OhDear\PhpSdk\Requests\Downtime;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteDowntimePeriodRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $downtimePeriodId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/downtime/{$this->downtimePeriodId}";
    }
}