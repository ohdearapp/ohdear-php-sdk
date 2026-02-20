<?php

namespace OhDear\PhpSdk\Requests\ManagedTeams;

use OhDear\PhpSdk\Dto\ManagedTeam;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetManagedTeamRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $resellerTeamId,
        protected int $managedTeamId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/reseller/{$this->resellerTeamId}/managed-teams/{$this->managedTeamId}";
    }

    public function createDtoFromResponse(Response $response): ManagedTeam
    {
        return ManagedTeam::fromResponse($response->json());
    }
}
