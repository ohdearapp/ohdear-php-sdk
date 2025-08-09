# Oh Dear PHP SDK (Saloon-Powered)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)
![Tests](https://github.com/ohdearapp/ohdear-php-sdk/workflows/run-tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)

A modern PHP SDK for the [Oh Dear](https://ohdear.app) API, built with [Saloon](https://docs.saloon.dev/) v3.

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

### Get all monitors

```php
// returns an iterator of OhDear\PhpSdk\Dto\Monitor
$monitors = $ohDear->monitors();

foreach($monitors as $monitor) {
    echo "Monitor: {$monitor->url} (ID: {$monitor->id})\n";
}
```

### Create a monitor

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

### Getting a single monitor

You can use the `monitor` method to get a single monitor.

```php
// returns OhDear\PhpSdk\Dto\Monitor
$monitor = $ohDear->monitor($monitorId);
```

### Deleting a monitor

You can use the `deleteMonitor` method to delete a monitor.

```php
$ohDear->deleteMonitor($monitorId)
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
