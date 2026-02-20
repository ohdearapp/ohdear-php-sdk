<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\ManagedTeam;
use OhDear\PhpSdk\Requests\ManagedTeams\CreateManagedTeamRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\DecoupleManagedTeamRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\DeleteManagedTeamRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\GetManagedTeamLoginLinkRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\GetManagedTeamRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\GetManagedTeamsRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\UpdateManagedTeamRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsManagedTeamEndpoints
{
    public function managedTeams(int $resellerTeamId): array
    {
        $request = new GetManagedTeamsRequest($resellerTeamId);

        return $this->send($request)->dtoOrFail();
    }

    public function managedTeam(int $resellerTeamId, int $managedTeamId): ManagedTeam
    {
        $request = new GetManagedTeamRequest($resellerTeamId, $managedTeamId);

        return $this->send($request)->dto();
    }

    public function createManagedTeam(int $resellerTeamId, array $data): ManagedTeam
    {
        $request = new CreateManagedTeamRequest($resellerTeamId, $data);

        return $this->send($request)->dto();
    }

    public function updateManagedTeam(int $resellerTeamId, int $managedTeamId, array $data): ManagedTeam
    {
        $request = new UpdateManagedTeamRequest($resellerTeamId, $managedTeamId, $data);

        return $this->send($request)->dto();
    }

    public function decoupleManagedTeam(int $resellerTeamId, int $managedTeamId): self
    {
        $request = new DecoupleManagedTeamRequest($resellerTeamId, $managedTeamId);

        $this->send($request);

        return $this;
    }

    public function deleteManagedTeam(int $resellerTeamId, int $managedTeamId): self
    {
        $request = new DeleteManagedTeamRequest($resellerTeamId, $managedTeamId);

        $this->send($request);

        return $this;
    }

    public function managedTeamLoginLink(int $resellerTeamId, int $managedTeamId): array
    {
        $request = new GetManagedTeamLoginLinkRequest($resellerTeamId, $managedTeamId);

        return $this->send($request)->dto();
    }
}
