<?php

namespace OhDear\PhpSdk\Requests\ManagedTeams;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DecoupleManagedTeamRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected int $resellerTeamId,
        protected int $managedTeamId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/reseller/{$this->resellerTeamId}/managed-teams/{$this->managedTeamId}/decouple";
    }
}
