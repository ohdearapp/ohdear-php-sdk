<?php

namespace OhDear\PhpSdk\Requests\CronCheckDefinitions;

use OhDear\PhpSdk\Dto\CronCheckDefinition;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class SyncCronCheckDefinitionsRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int $monitorId,
        protected array $cronChecks,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/cron-checks/sync";
    }

    protected function defaultBody(): array
    {
        return [
            'cron_checks' => $this->cronChecks,
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        return CronCheckDefinition::collect($response->json('data'));
    }
}
