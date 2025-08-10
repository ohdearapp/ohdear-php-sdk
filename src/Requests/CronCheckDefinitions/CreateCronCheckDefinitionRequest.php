<?php

namespace OhDear\PhpSdk\Requests\CronCheckDefinitions;

use OhDear\PhpSdk\Dto\CronCheckDefinition;
use OhDear\PhpSdk\Enums\CronType;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateCronCheckDefinitionRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int $monitorId,
        protected array $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/cron-checks";
    }

    protected function defaultBody(): array
    {
        $data = $this->data;

        if (isset($data['type']) && $data['type'] instanceof CronType) {
            $data['type'] = $data['type']->value;
        }

        return $data;
    }

    public function createDtoFromResponse(Response $response): CronCheckDefinition
    {
        return CronCheckDefinition::fromResponse($response->json());
    }
}
