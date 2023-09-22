<?php

namespace OhDear\PhpSdk\Resources;

class NotificationDestination extends ApiResource
{
    public int $id;

    public ?int $teamId = null;

    public string $channel;

    /** @var array<string, mixed> */
    public array $destination;

    /** @var array<int, string> */
    public array $notificationTypes;
}
