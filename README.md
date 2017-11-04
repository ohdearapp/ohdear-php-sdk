> Package in development, do not use yet

# An SDK to easily work with the Oh Dear API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)
[![Build Status](https://img.shields.io/travis/ohdearapp/ohdear-php-sdk/master.svg?style=flat-square)](https://travis-ci.org/ohdearapp/ohdear-php-sdk)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/49062048-b90d-423b-b6a3-bfe273376639.svg?style=flat-square)](https://insight.sensiolabs.com/projects/49062048-b90d-423b-b6a3-bfe273376639)
[![Quality Score](https://img.shields.io/scrutinizer/g/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/ohdearapp/ohdear-php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)

This SDK lets you perform API calls to [Oh Dear](https://ohdearapp.com).

Here are some quick examples:

```php
$ohDear->sites(); // returns all sites

$site = $ohdear->site($siteId);

$site->url; // returns the url of the site

$checks = $site->checks; // returns all checks for the site

$check->type; // returns the check type eg. "uptime" or "mixed-content"

$checks[0]->disable(); // disable the check

$site->delete(); // delete a site
```

## Installation

You can install the package via composer:

```bash
composer require ohdearapp/ohdear-php-sdk
```

## Usage

In order to get started with this SDK you'll need to generate at API key at [the API panel of Oh Dear](https://ohdearapp.com/xxxxx).

You can use the API key to new up an instance of `OhDear\PhpSdk\Ohdear`:

```php
$ohDear = new OhDear\PhpSdk\Ohdear($apiKey);
```

### Sites

#### Creating a new site

A new site can be created with `createSite`. 

```php
$ohDear->createSite(['url' => 'https://yoursite', 'team_id' => $yourTeamId]);
```

Take a look at [the User section](#getting-your-user-info) to learn how to get your team id.

When an `https` site is created, [all checks](TODO:linkToDocsWithAllChecks) will automatically be enabled. When a `http` is created only the `uptime check` will be enabled.

#### Getting sites
You can get all sites with:

```php
$sites = $ohDear->sites();
```

This will return an array of `OhDear\PhpSdk\Resources\Site` instances. 

You can get a few properties of a site.
```php
$site->id;
$site->url;
...
```

You can also get a single site:

```php
$ohDear->site($siteId);
```

#### Deleting a site
A site can be deleted:

```php
$site->delete(); // bye bye
```

### Checks

#### Getting all checks

You can get all checks of a site:

```php
$checks = $site->checks;
```

This will return an array with instances of `OhDear\PhpSdk\Resources\Check`:

```php
$check->id; // returns the id
$check->type; // returns the check type eg. "uptime" or "mixed-content"
```

#### Disabling a check

If you want to disable a check just call `disable` on it:

```php
$check->disable(); // OhDear will not run the check anymore
```

#### Enabling a check

If you want to renable the check just call `enable` on it:

```php
$check->enable(); // back in business
```

#### Requesting a new run

If you want OhDear to perform a specific check asap, call `requestRun`

```php
$check->requestRun(); // OhDear will perform the check in a bit
```

### Getting your user info

You can get your user info:

```php
$user = $ohDear->me();
```

`me` will return an instance of `OhDear\PhpSdk\Resources\User`;

```php
$user->name; // returns your name
$user->email; // returns your email
```

You can get the teams you belong to:

```php
$teams = $user->teams();
```

`$teams` is an array of `OhDear\PhpSdk\Resources\Team`

```php
$team->id // returns the id of the team
$team->name // returns the name of the team
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email support@ohdearapp.com instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

This package uses code from and is greatly inspired by the [Forge SDK package](https://github.com/themsaid/forge-sdk) by [Mohammed Said](https://github.com/themsaid).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
