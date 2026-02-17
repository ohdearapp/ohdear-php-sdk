<?php

namespace OhDear\PhpSdk\Requests\StatusPages;

use OhDear\PhpSdk\Dto\StatusPageUpdate;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateStatusPageUpdateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $statusPageUpdateId,
        protected array $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/status-page-updates/{$this->statusPageUpdateId}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): StatusPageUpdate
    {
        return StatusPageUpdate::fromResponse($response->json());
    }
}
