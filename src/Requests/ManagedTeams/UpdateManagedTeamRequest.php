<?php

namespace OhDear\PhpSdk\Requests\ManagedTeams;

use OhDear\PhpSdk\Dto\ManagedTeam;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateManagedTeamRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $resellerTeamId,
        protected int $managedTeamId,
        protected array $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/reseller/{$this->resellerTeamId}/managed-teams/{$this->managedTeamId}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ManagedTeam
    {
        return ManagedTeam::fromResponse($response->json());
    }
}
