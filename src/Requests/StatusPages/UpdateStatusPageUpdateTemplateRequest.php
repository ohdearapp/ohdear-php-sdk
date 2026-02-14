<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use OhDear\PhpSdk\Dto\StatusPageUpdateTemplate;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateStatusPageUpdateTemplateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $templateId,
        protected array $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/status-page-update-templates/{$this->templateId}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): StatusPageUpdateTemplate
    {
        return StatusPageUpdateTemplate::fromResponse($response->json());
    }
}
