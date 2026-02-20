<?php

namespace OhDear\PhpSdk\Requests\ManagedTeams;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetManagedTeamLoginLinkRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $resellerTeamId,
        protected int $managedTeamId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/reseller/{$this->resellerTeamId}/managed-teams/{$this->managedTeamId}/login-link";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return $response->json();
    }
}
