<?php

use OhDear\PhpSdk\Requests\ManagedTeams\CreateManagedTeamRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\DecoupleManagedTeamRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\DeleteManagedTeamRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\GetManagedTeamLoginLinkRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\GetManagedTeamRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\GetManagedTeamsRequest;
use OhDear\PhpSdk\Requests\ManagedTeams\UpdateManagedTeamRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get managed teams', function () {
    MockClient::global([
        GetManagedTeamsRequest::class => MockResponse::fixture('managed-teams'),
    ]);

    $managedTeams = $this->ohDear->managedTeams(1);

    expect($managedTeams)->toBeArray();
    expect($managedTeams)->toHaveCount(2);
    expect($managedTeams[0]->id)->toBe(1);
    expect($managedTeams[0]->name)->toBe('Client Company');
    expect($managedTeams[0]->timezone)->toBe('UTC');
    expect($managedTeams[0]->monitorsCount)->toBe(5);
});

it('can get a single managed team', function () {
    MockClient::global([
        GetManagedTeamRequest::class => MockResponse::fixture('managed-team'),
    ]);

    $managedTeam = $this->ohDear->managedTeam(1, 1);

    expect($managedTeam->id)->toBe(1);
    expect($managedTeam->name)->toBe('Client Company');
    expect($managedTeam->timezone)->toBe('UTC');
    expect($managedTeam->monitorsCount)->toBe(5);
});

it('can create a managed team', function () {
    MockClient::global([
        CreateManagedTeamRequest::class => MockResponse::fixture('create-managed-team'),
    ]);

    $managedTeam = $this->ohDear->createManagedTeam(1, [
        'name' => 'New Client',
        'timezone' => 'Europe/Brussels',
    ]);

    expect($managedTeam->id)->toBe(3);
    expect($managedTeam->name)->toBe('New Client');
    expect($managedTeam->timezone)->toBe('Europe/Brussels');
});

it('can update a managed team', function () {
    MockClient::global([
        UpdateManagedTeamRequest::class => MockResponse::fixture('update-managed-team'),
    ]);

    $managedTeam = $this->ohDear->updateManagedTeam(1, 1, [
        'name' => 'Updated Client Company',
        'timezone' => 'Europe/London',
    ]);

    expect($managedTeam->id)->toBe(1);
    expect($managedTeam->name)->toBe('Updated Client Company');
    expect($managedTeam->timezone)->toBe('Europe/London');
});

it('can decouple a managed team', function () {
    MockClient::global([
        DecoupleManagedTeamRequest::class => MockResponse::fixture('decouple-managed-team'),
    ]);

    $this->ohDear->decoupleManagedTeam(1, 1);

    markTestComplete();
});

it('can delete a managed team', function () {
    MockClient::global([
        DeleteManagedTeamRequest::class => MockResponse::fixture('delete-managed-team'),
    ]);

    $this->ohDear->deleteManagedTeam(1, 1);

    markTestComplete();
});

it('can get a managed team login link', function () {
    MockClient::global([
        GetManagedTeamLoginLinkRequest::class => MockResponse::fixture('managed-team-login-link'),
    ]);

    $loginLink = $this->ohDear->managedTeamLoginLink(1, 1);

    expect($loginLink['login_url'])->toContain('ohdear.app/reseller-login');
    expect($loginLink['valid_until'])->toBe('2025-01-01 12:05:00');
});
