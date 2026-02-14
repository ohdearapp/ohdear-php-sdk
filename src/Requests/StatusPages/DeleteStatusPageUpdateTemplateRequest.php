<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteStatusPageUpdateTemplateRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $templateId
    ) {}

    public function resolveEndpoint(): string
    {
        return "/status-page-update-templates/{$this->templateId}";
    }
}
