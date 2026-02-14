<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use OhDear\PhpSdk\Dto\StatusPageUpdateTemplate;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetStatusPageUpdateTemplatesRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/status-page-update-templates';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return StatusPageUpdateTemplate::collect($response->json('data'));
    }
}
