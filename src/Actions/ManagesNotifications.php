<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\NotificationDestination;

trait ManagesNotifications
{
    /** @return array<int, NotificationDestination> */
    public function teamNotificationDestinations(): array
    {
        return $this->transformCollection(
            $this->get('team-notification-destinations')['data'],
            NotificationDestination::class
        );
    }

    /** @return array<int, NotificationDestination> */
    public function siteNotificationDestinations(int $siteId): array
    {
        return $this->transformCollection(
            $this->get("sites/{$siteId}/notification-destinations")['data'],
            NotificationDestination::class
        );
    }
}
