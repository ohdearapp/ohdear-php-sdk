<?php

use OhDear\PhpSdk\Requests\Monitors\DeleteNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\Monitors\UpdateNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\CreateTagGroupNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\CreateTagNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\CreateTeamNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\GetTagGroupNotificationDestinationsRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\GetTagNotificationDestinationsRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\GetTeamNotificationDestinationsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can update a monitor notification destination', function () {
    MockClient::global([
        UpdateNotificationDestinationRequest::class => MockResponse::fixture('update-notification-destination'),
    ]);

    $destination = $this->ohDear->updateNotificationDestination(82060, 456, [
        'channel' => 'mail',
        'destination' => ['mail' => 'updated@example.com'],
    ]);

    expect($destination->id)->toBe(456);
    expect($destination->channel)->toBe('mail');
});

it('can delete a monitor notification destination', function () {
    MockClient::global([
        DeleteNotificationDestinationRequest::class => MockResponse::fixture('delete-notification-destination'),
    ]);

    $this->ohDear->deleteNotificationDestination(82060, 456);

    markTestComplete();
});

it('can get team notification destinations', function () {
    MockClient::global([
        GetTeamNotificationDestinationsRequest::class => MockResponse::fixture('team-notification-destinations'),
    ]);

    $destinations = $this->ohDear->teamNotificationDestinations();

    expect($destinations)->toBeArray();
    foreach ($destinations as $destination) {
        expect($destination->id)->toBeInt();
    }
});

it('can create a team notification destination', function () {
    MockClient::global([
        CreateTeamNotificationDestinationRequest::class => MockResponse::fixture('create-team-notification-destination'),
    ]);

    $destination = $this->ohDear->createTeamNotificationDestination(19245, [
        'channel' => 'mail',
        'destination' => ['mail' => 'team@example.com'],
    ]);

    expect($destination->id)->toBe(101);
    expect($destination->channel)->toBe('mail');
});

it('can get tag notification destinations', function () {
    MockClient::global([
        GetTagNotificationDestinationsRequest::class => MockResponse::fixture('tag-notification-destinations'),
    ]);

    $destinations = $this->ohDear->tagNotificationDestinations();

    expect($destinations)->toBeArray();
    foreach ($destinations as $destination) {
        expect($destination->id)->toBeInt();
    }
});

it('can create a tag notification destination', function () {
    MockClient::global([
        CreateTagNotificationDestinationRequest::class => MockResponse::fixture('create-tag-notification-destination'),
    ]);

    $destination = $this->ohDear->createTagNotificationDestination(1, [
        'channel' => 'mail',
        'destination' => ['mail' => 'newtag@example.com'],
    ]);

    expect($destination->id)->toBe(201);
    expect($destination->channel)->toBe('mail');
});

it('can get tag group notification destinations', function () {
    MockClient::global([
        GetTagGroupNotificationDestinationsRequest::class => MockResponse::fixture('tag-group-notification-destinations'),
    ]);

    $destinations = $this->ohDear->tagGroupNotificationDestinations(1);

    expect($destinations)->toBeArray();
    foreach ($destinations as $destination) {
        expect($destination->id)->toBeInt();
    }
});

it('can create a tag group notification destination', function () {
    MockClient::global([
        CreateTagGroupNotificationDestinationRequest::class => MockResponse::fixture('create-tag-group-notification-destination'),
    ]);

    $destination = $this->ohDear->createTagGroupNotificationDestination(1, [
        'channel' => 'mail',
        'destination' => ['mail' => 'taggroup@example.com'],
    ]);

    expect($destination->id)->toBe(301);
    expect($destination->channel)->toBe('mail');
});
