<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\NotificationDestination;
use OhDear\PhpSdk\Requests\NotificationDestinations\CreateTagGroupNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\CreateTagNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\CreateTeamNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\DeleteTagGroupNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\DeleteTagNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\DeleteTeamNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\GetTagGroupNotificationDestinationsRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\GetTagNotificationDestinationsRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\GetTeamNotificationDestinationsRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\UpdateTagGroupNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\UpdateTagNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\NotificationDestinations\UpdateTeamNotificationDestinationRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsNotificationDestinationEndpoints
{
    public function teamNotificationDestinations(): array
    {
        $request = new GetTeamNotificationDestinationsRequest();

        return $this->send($request)->dto();
    }

    public function createTeamNotificationDestination(int $teamId, array $data): NotificationDestination
    {
        $request = new CreateTeamNotificationDestinationRequest($teamId, $data);

        return $this->send($request)->dto();
    }

    public function updateTeamNotificationDestination(int $teamId, int $destinationId, array $data): NotificationDestination
    {
        $request = new UpdateTeamNotificationDestinationRequest($teamId, $destinationId, $data);

        return $this->send($request)->dto();
    }

    public function deleteTeamNotificationDestination(int $teamId, int $destinationId): self
    {
        $request = new DeleteTeamNotificationDestinationRequest($teamId, $destinationId);

        $this->send($request);

        return $this;
    }

    public function tagNotificationDestinations(): array
    {
        $request = new GetTagNotificationDestinationsRequest();

        return $this->send($request)->dto();
    }

    public function createTagNotificationDestination(int $tagId, array $data): NotificationDestination
    {
        $request = new CreateTagNotificationDestinationRequest($tagId, $data);

        return $this->send($request)->dto();
    }

    public function updateTagNotificationDestination(int $tagId, int $destinationId, array $data): NotificationDestination
    {
        $request = new UpdateTagNotificationDestinationRequest($tagId, $destinationId, $data);

        return $this->send($request)->dto();
    }

    public function deleteTagNotificationDestination(int $tagId, int $destinationId): self
    {
        $request = new DeleteTagNotificationDestinationRequest($tagId, $destinationId);

        $this->send($request);

        return $this;
    }

    public function tagGroupNotificationDestinations(int $tagGroupId): array
    {
        $request = new GetTagGroupNotificationDestinationsRequest($tagGroupId);

        return $this->send($request)->dto();
    }

    public function createTagGroupNotificationDestination(int $tagGroupId, array $data): NotificationDestination
    {
        $request = new CreateTagGroupNotificationDestinationRequest($tagGroupId, $data);

        return $this->send($request)->dto();
    }

    public function updateTagGroupNotificationDestination(int $tagGroupId, int $destinationId, array $data): NotificationDestination
    {
        $request = new UpdateTagGroupNotificationDestinationRequest($tagGroupId, $destinationId, $data);

        return $this->send($request)->dto();
    }

    public function deleteTagGroupNotificationDestination(int $tagGroupId, int $destinationId): self
    {
        $request = new DeleteTagGroupNotificationDestinationRequest($tagGroupId, $destinationId);

        $this->send($request);

        return $this;
    }
}
