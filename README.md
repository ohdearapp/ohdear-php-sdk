# Oh Dear PHP SDK (Saloon-Powered)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)
![Tests](https://github.com/ohdearapp/ohdear-php-sdk/workflows/run-tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)

A modern PHP SDK for the [Oh Dear](https://ohdear.app) API, built with [Saloon](https://docs.saloon.dev/) v3.

## Installation

```bash
composer require ohdearapp/ohdear-php-sdk
```

## Usage

### Basic Setup

```php
use OhDear\PhpSdk\OhDear;

$ohDear = new OhDear('your-api-token');
```

### Making Requests (The Saloon Way)

This SDK is built on Saloon v3, giving you the full power of Saloon's HTTP client:

#### Get All Monitors

```php
use OhDear\PhpSdk\Dto\Monitor;use OhDear\PhpSdk\Requests\Monitors\GetMonitorsRequest;

$response = $ohDear->send(new GetMonitorsRequest);
$monitors = Monitor::collect($response->json('data'));

foreach ($monitors as $monitor) {
    echo "Monitor: {$monitor->url} (ID: {$monitor->id})\n";
}
```

#### Get Single Monitor

```php
use OhDear\PhpSdk\Dto\Monitor;use OhDear\PhpSdk\Requests\Monitors\GetMonitorRequest;

$response = $ohDear->send(new GetMonitorRequest(123));

$monitor = Monitor::fromResponse($response->json());

echo "Monitor URL: {$monitor->url}\n";
```

#### Create Monitor

```php
use OhDear\PhpSdk\Dto\Monitor;use OhDear\PhpSdk\Requests\Monitors\CreateMonitorRequest;

$response = $ohDear->send(new CreateMonitorRequest([
    'url' => 'https://example.com',
    'label' => 'My Website'
]));

$monitor = Monitor::fromResponse($response->json());

echo "Created monitor with ID: {$monitor->id}\n";
```

#### Get User Info

```php
use OhDear\PhpSdk\Dto\User;use OhDear\PhpSdk\Requests\Users\GetMeRequest;

$response = $ohDear->send(new GetMeRequest);

$user = User::fromResponse($response->json());

echo "Hello, {$user->name}!\n";
```

#### Get Uptime Data

```php
use OhDear\PhpSdk\Dto\Uptime;use OhDear\PhpSdk\Requests\Monitors\GetUptimeRequest;

$response = $ohDear->send(new GetUptimeRequest(
    monitorId: 123,
    startedAt: '20240101000000',
    endedAt: '20240131000000',
    split: 'day'
));

$uptimeData = Uptime::collect($response->json());

foreach ($uptimeData as $uptime) {
    echo "Date: {$uptime->datetime}, Uptime: {$uptime->uptimePercentage}%\n";
}
```

### Testing with Saloon

Use Saloon's powerful mocking capabilities for testing:

```php
use OhDear\PhpSdk\Requests\Monitors\GetMonitorsRequest;use Saloon\Http\Faking\MockClient;use Saloon\Http\Faking\MockResponse;

$mockClient = new MockClient([
    GetMonitorsRequest::class => MockResponse::make([
        'data' => [
            [
                'id' => 1,
                'url' => 'https://example.com',
                'sort_url' => 'example.com',
                'checks' => [],
            ]
        ]
    ], 200),
]);

$ohDear = new OhDear('test-token');

$ohDear->withMockClient($mockClient);

// Your tests here...
```

### Date Utilities

The connector includes a date conversion helper:

```php
$ohDear->convertDateFormat('2024-01-01'); // Returns: 20240101000000
$ohDear->convertDateFormat('2024-01-01 12:30:00'); // Returns: 20240101123000
$ohDear->convertDateFormat('2024-01-01', 'Y-m-d'); // Returns: 2024-01-01
```

## Requirements

- PHP 8.1 or higher
- Saloon v3

## Security

If you discover any security related issues, please email support@ohdear.app instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
