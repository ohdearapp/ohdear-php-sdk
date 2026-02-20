<?php

namespace OhDear\PhpSdk\Requests\ManagedTeams;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteManagedTeamRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $resellerTeamId,
        protected int $managedTeamId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/reseller/{$this->resellerTeamId}/managed-teams/{$this->managedTeamId}";
    }
}
