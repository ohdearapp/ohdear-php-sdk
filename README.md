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

$site->url // returns the url of the site

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

Coming soon

### Testing

``` bash
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
