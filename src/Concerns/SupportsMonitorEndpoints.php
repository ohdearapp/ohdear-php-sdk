<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\CheckSummary;
use OhDear\PhpSdk\Dto\Monitor;
use OhDear\PhpSdk\Dto\NotificationDestination;
use OhDear\PhpSdk\Enums\CheckType;
use OhDear\PhpSdk\Requests\Monitors\AddToBrokenLinksWhitelistRequest;
use OhDear\PhpSdk\Requests\Monitors\CreateMonitorRequest;
use OhDear\PhpSdk\Requests\Monitors\CreateNotificationDestinationsRequest;
use OhDear\PhpSdk\Requests\Monitors\DeleteMonitorRequest;
use OhDear\PhpSdk\Requests\Monitors\DeleteNotificationDestinationRequest;
use OhDear\PhpSdk\Requests\Monitors\GetCheckSummaryRequest;
use OhDear\PhpSdk\Requests\Monitors\GetMonitorByUrlRequest;
use OhDear\PhpSdk\Requests\Monitors\GetMonitorRequest;
use OhDear\PhpSdk\Requests\Monitors\GetMonitorsRequest;
use OhDear\PhpSdk\Requests\Monitors\GetNotificationDestinationsRequest;
use OhDear\PhpSdk\Requests\Monitors\UpdateMonitorRequest;
use OhDear\PhpSdk\Requests\Monitors\UpdateNotificationDestinationRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsMonitorEndpoints
{
    /** @return iterable<int, Monitor> */
    public function monitors(?int $teamId = null): iterable
    {
        $request = new GetMonitorsRequest($teamId);

        /** @var iterable<int, Monitor> $items */
        $items = $this->paginate($request)->items();

        return $items;
    }

    public function monitor(int $monitorId): Monitor
    {
        $request = new GetMonitorRequest($monitorId);

        return $this->send($request)->dto();
    }

    public function createMonitor(array $properties): Monitor
    {
        $request = new CreateMonitorRequest($properties);

        return $this->send($request)->dto();
    }

    public function updateMonitor(int $monitorId, array $monitorProperties): Monitor
    {
        $request = new UpdateMonitorRequest($monitorId, $monitorProperties);

        return $this->send($request)->dto();
    }

    public function deleteMonitor(int $monitorId): self
    {
        $request = new DeleteMonitorRequest($monitorId);

        $this->send($request);

        return $this;
    }

    public function checkSummary(int $monitorId, CheckType $checkType): CheckSummary
    {
        $request = new GetCheckSummaryRequest($monitorId, $checkType);

        return $this->send($request)->dto();
    }

    public function notificationDestinations(int $monitorId): array
    {
        $request = new GetNotificationDestinationsRequest($monitorId);

        return $this->send($request)->dto();
    }

    public function createNotificationDestination(int $monitorId, array $properties): NotificationDestination
    {
        $request = new CreateNotificationDestinationsRequest($monitorId, $properties);

        return $this->send($request)->dto();
    }

    public function monitorByUrl(string $url): Monitor
    {
        $request = new GetMonitorByUrlRequest($url);

        return $this->send($request)->dto();
    }

    public function addToBrokenLinksWhitelist(int $monitorId, string $url): self
    {
        $request = new AddToBrokenLinksWhitelistRequest($monitorId, $url);

        $this->send($request);

        return $this;
    }

    public function updateNotificationDestination(int $monitorId, int $destinationId, array $data): NotificationDestination
    {
        $request = new UpdateNotificationDestinationRequest($monitorId, $destinationId, $data);

        return $this->send($request)->dto();
    }

    public function deleteNotificationDestination(int $monitorId, int $destinationId): self
    {
        $request = new DeleteNotificationDestinationRequest($monitorId, $destinationId);

        $this->send($request);

        return $this;
    }
}
