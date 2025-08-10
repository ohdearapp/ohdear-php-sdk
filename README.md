# Oh Dear PHP SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)
![Tests](https://github.com/ohdearapp/ohdear-php-sdk/workflows/run-tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)

This package is the official PHP SDK for the [Oh Dear](https://ohdear.app) API, built with [Saloon](https://docs.saloon.dev/) v3.

```php
use OhDear\PhpSdk\OhDear;
use OhDear\PhpSdk\Dto\Monitor;
use OhDear\PhpSdk\Requests\Monitors\{GetMonitorsRequest, CreateMonitorRequest};

$ohDear = new OhDear('your-api-token');

$ohDear->createMonitor([
    'url' => 'https://example.com',
    'type' => 'http',
    'team_id' => 1,
])

// returns an iterator of OhDear\PhpSdk\Dto\Monitor
$monitors = $ohDear->monitors();

foreach($monitors as $monitor) {
    echo "Monitor: {$monitor->url} (ID: {$monitor->id})\n";
}
```

Behind the scenes, the SDK uses [Saloon](https://docs.saloon.dev) to make the HTTP requests.

## Installation

```bash
composer require ohdearapp/ohdear-php-sdk
```

## Oh Dear documentation

To get started, we highly recommend reading
the [Oh Dear API documentation](https://ohdear.app/docs/integrations/the-oh-dear-api).

## Usage

To authenticate, you'll need an API token. You can create one in
the [API tokens screen at Oh Dear](https://ohdear.app/user/api-tokens).

```php
use OhDear\PhpSdk\OhDear;

$ohDear = new OhDear('your-api-token');
```

### Handling errors

The SDK will throw an exception if the API returns an error. For validation errors, the SDK will throw a `ValidationException`.

```php
try {
    $ohDear->createMonitor([
        'url' => 'invalid-url',
    ]);
} catch (\OhDear\PhpSdk\Exceptions\ValidationException $exception) {
    $exception->getMessage(); // returns a string describing the errors
    
    $exception->errors(); // returns an array with all validation errors
}
```

For all other errors, the SDK will throw an `\OhDear\PhpSdk\Exceptions\OhDearException`.

### Get user info

```php
// returns OhDear\PhpSdk\Dto\User
$user = $ohDear->me();

echo $user->email // returns the email address of the authenticated user
```

### Monitors

Monitors are the core of Oh Dear - they watch your websites, APIs, and services for uptime, performance, SSL certificates, broken links, and more. You can create different types of monitors (HTTP, ping, TCP) and configure various checks for each one.

#### Get all monitors

```php
// returns an iterator of OhDear\PhpSdk\Dto\Monitor
$monitors = $ohDear->monitors();

foreach($monitors as $monitor) {
    echo "Monitor: {$monitor->url} (ID: {$monitor->id})\n";
}
```

#### Create a monitor

You can use the `createMonitor` method to create a monitor.

```php 
$monitor = $ohDear->createMonitor([
    'url' => 'https://example.com',
    'type' => 'http',
    'team_id' => 1,
]);

echo $monitor->url; // returns https://example.com
```

You can find a list of attributes you can pass to the `createMonitor` method in the [Oh Dear API documentation](#oh-dear-documentation).

#### Getting a single monitor

You can use the `monitor` method to get a single monitor.

```php
// returns OhDear\PhpSdk\Dto\Monitor
$monitor = $ohDear->monitor($monitorId);
```

#### Deleting a monitor

You can use the `deleteMonitor` method to delete a monitor.

```php
$ohDear->deleteMonitor($monitorId);
```

### Status pages

Status pages provide a public way to communicate the status of your services to your users. They automatically reflect the health of your monitors and allow you to post updates during incidents or maintenance windows.

#### Get all status pages

```php
// returns an iterator of OhDear\PhpSdk\Dto\StatusPage
$statusPages = $ohDear->statusPages();

foreach($statusPages as $statusPage) {
    echo "Status Page: {$statusPage->title} (ID: {$statusPage->id})\n";
}
```

#### Getting a single status page

You can use the `statusPage` method to get a single status page.

```php
// returns OhDear\PhpSdk\Dto\StatusPage
$statusPage = $ohDear->statusPage($statusPageId);
```

#### Deleting a status page

You can use the `deleteStatusPage` method to delete a status page.

```php
$ohDear->deleteStatusPage($statusPageId)
```

### Checks

Checks are individual monitoring tasks that belong to monitors (like uptime, SSL certificate, performance, broken links, etc.). You can control each check independently - enabling, disabling, requesting immediate runs, and temporarily snoozing notifications.

#### Enabling a check

You can enable a check using its ID:

```php
// Returns OhDear\PhpSdk\Dto\Check
$check = $ohDear->enableCheck($checkId);

echo $check->enabled; // true
```

#### Disabling a check

You can disable a check using its ID:

```php
// Returns OhDear\PhpSdk\Dto\Check
$check = $ohDear->disableCheck($checkId);

echo $check->enabled;
```

#### Requesting a check run

You can request an immediate run of a check:

```php
// Basic run request
// Returns OhDear\PhpSdk\Dto\Check
$check = $ohDear->requestCheckRun($checkId);

// For uptime checks, you can also pass custom HTTP headers
$check = $ohDear->requestCheckRun($checkId, [
    'User-Agent' => 'Custom User Agent',
    'Authorization' => 'Bearer token123',
]);
```

#### Snoozing a check

You can snooze a check for a specified number of minutes (1 to 144000 minutes):

```php
// Snooze a check for 60 minutes
$check = $ohDear->snoozeCheck($checkId, 60);

echo $check->active_snooze ? 'Check is snoozed' : 'Check is active';
```

#### Unsnoozing a check

You can unsnooze a check to make it active again:

```php
$check = $ohDear->unsnoozeCheck($checkId);

echo $check->active_snooze ? 'Check is still snoozed' : 'Check is now active';
```

### Maintenance Periods

Maintenance periods allow you to temporarily disable notifications for monitors during planned maintenance windows.

#### Getting maintenance periods for a monitor

You can get all maintenance periods for a specific monitor:

```php
// returns an iterator of OhDear\PhpSdk\Dto\MaintenancePeriod
$maintenancePeriods = $ohDear->maintenancePeriods($monitorId);

foreach ($maintenancePeriods as $period) {
    echo "Maintenance: {$period->name} from {$period->starts_at} to {$period->ends_at}\n";
}

// You can also filter by date range
$periods = $ohDear->maintenancePeriods($monitorId, '2024-01-01 00:00:00', '2024-12-31 23:59:59');
```

#### Starting a maintenance period

You can start an immediate maintenance period for a monitor:

```php
// Start maintenance for 1 hour (3600 seconds) - default duration
$period = $ohDear->startMaintenancePeriod($monitorId);

// Start maintenance for a custom duration with a name
$period = $ohDear->startMaintenancePeriod($monitorId, 7200, 'Database Migration');

echo "Maintenance started: {$period->name}";
```

#### Stopping maintenance periods

You can stop all active maintenance periods for a monitor:

```php
$ohDear->stopMaintenancePeriod($monitorId);
```

#### Creating a scheduled maintenance period

You can create a maintenance period scheduled for the future:

```php
$period = $ohDear->createMaintenancePeriod([
    'monitor_id' => $monitorId,
    'name' => 'Scheduled Server Maintenance',
    'starts_at' => '2024-12-25 02:00',
    'ends_at' => '2024-12-25 06:00',
]);

echo "Scheduled maintenance: {$period->name}";
```

#### Updating a maintenance period

You can update an existing maintenance period:

```php
$period = $ohDear->updateMaintenancePeriod($maintenancePeriodId, [
    'name' => 'Updated Maintenance Window',
    'starts_at' => '2024-12-25 01:00',
    'ends_at' => '2024-12-25 05:00',
]);
```

#### Deleting a maintenance period

You can delete a maintenance period:

```php
$ohDear->deleteMaintenancePeriod($maintenancePeriodId);
```

### Uptime Metrics

Uptime metrics provide detailed performance and timing data for your monitors over time. Different monitor types (Http, Ping, TCP) provide different metrics.

#### Getting HTTP uptime metrics

For HTTP monitors, you can get detailed timing metrics including DNS, TCP, SSL handshake times and cURL statistics:

```php
use OhDear\PhpSdk\Enums\UptimeMetricsSplit;

// Get HTTP metrics for the last 24 hours, grouped by hour
$startDate = date('Y-m-d H:i:s', strtotime('-24 hours'));
$endDate = date('Y-m-d H:i:s');

$metrics = $ohDear->httpUptimeMetrics($monitorId, $startDate, $endDate, UptimeMetricsSplit::Hour);

foreach ($metrics as $metric) {
    echo "Date: {$metric->date};
    echo "Total time: {$metric->total_time_in_seconds}s;
    echo "DNS time: {$metric->dns_time_in_seconds}s;
    echo "TCP time: {$metric->tcp_time_in_seconds}s;
    echo "SSL handshake: {$metric->ssl_handshake_time_in_seconds}s;
    echo "Download time: {$metric->download_time_in_seconds}s;
    echo "cURL total time: {$metric->curl['total_time']}s;
}
```

#### Getting ping uptime metrics

For ping monitors, you can get response times, packet loss, and uptime percentages:

```php
$metrics = $ohDear->pingUptimeMetrics($monitorId, $startDate, $endDate, UptimeMetricsSplit::Hour);

foreach ($metrics as $metric) {
    echo "Date: {$metric->date}";
    echo "Average response time: {$metric->average_time_in_ms}ms";
    echo "Packet loss: {$metric->packet_loss_percentage}%";
    echo "Uptime: {$metric->uptime_percentage}%";
    echo "Uptime seconds: {$metric->uptime_seconds}";
    echo "Downtime seconds: {$metric->downtime_seconds}";
}
```

#### Getting TCP uptime metrics

For TCP monitors, you can get connection times and uptime data:

```php
$metrics = $ohDear->tcpUptimeMetrics($monitorId, $startDate, $endDate, UptimeMetricsSplit::Hour);

foreach ($metrics as $metric) {
    echo "Date: {$metric->date}";
    echo "Time to connect: {$metric->time_to_connect_in_ms}ms";
    echo "Uptime: {$metric->uptime_percentage}%";
    echo "Downtime: {$metric->downtime_percentage}%";
}
```

### Using Saloon requests directly

This SDK uses [Saloon](https://docs.saloon.dev) to make the HTTP requests. Instead of using the `OhDear` class, you can the underlying request classes directly. This way, you have full power to customize the requests.

```php
use OhDear\PhpSdk\Requests\Monitors\GetMonitorsRequest;

$request = new GetMonitorsRequest();

// raw response from the Oh Dear API
$response = $ohDear->send($request);
```

Take a look at the [Saloon documentation](https://docs.saloon.dev) to learn more about how to customize the requests.

## Security

If you discover any security related issues, please email support@ohdear.app instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
