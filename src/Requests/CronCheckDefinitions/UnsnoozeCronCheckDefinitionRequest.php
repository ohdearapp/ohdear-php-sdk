<?php

namespace OhDear\PhpSdk\Requests\CronCheckDefinitions;

use OhDear\PhpSdk\Dto\CronCheckDefinition;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class UnsnoozeCronCheckDefinitionRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected int $cronCheckDefinitionId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/cron-checks/{$this->cronCheckDefinitionId}/unsnooze";
    }

    public function createDtoFromResponse(Response $response): CronCheckDefinition
    {
        return CronCheckDefinition::fromResponse($response->json());
    }
}
