<?php

namespace OhDear\PhpSdk\Requests\ManagedTeams;

use OhDear\PhpSdk\Dto\ManagedTeam;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetManagedTeamsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $resellerTeamId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/reseller/{$this->resellerTeamId}/managed-teams";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return ManagedTeam::collect($response->json('data'));
    }
}
