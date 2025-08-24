<?php

namespace OhDear\PhpSdk\Requests\CronCheckDefinitions;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteCronCheckDefinitionRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $cronCheckDefinitionId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/cron-checks/{$this->cronCheckDefinitionId}";
    }
}
