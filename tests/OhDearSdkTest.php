<?php

declare(strict_types=1);

use OhDear\PhpSdk\OhDear;

it('can instantiate an object', function () {
    $sdk = new OhDear('api-token');

    expect($sdk)->toBeObject();
});

it('has support for performance records', function () {
    $sdk = new OhDear('api-token');

    expect(method_exists($sdk, 'performanceRecords'))->toBeTrue();
});

it('can convert short date formats', function () {
    $sdk = new OhDear('api-token');

    $startDate = '2020-06-08';
    $endDate = '2020-06-09';

    expect($sdk->convertDateFormat($startDate))->toBe('20200608000000')
        ->and($sdk->convertDateFormat($endDate))->toBe('20200609000000');
});

it('can convert long date formats', function () {
    $sdk = new OhDear('api-token');

    $startDate = '2020-06-08 12:00:00';
    $endDate = '2020-06-09 12:00:00';


    expect($sdk->convertDateFormat($startDate))->toBe('20200608120000')
        ->and($sdk->convertDateFormat($endDate))->toBe('20200609120000');
});

it('can convert date formats to a custom format', function () {
    $sdk = new OhDear('api-token');

    $date = '2020-06-09 12:00:00';

    expect($sdk->convertDateFormat($date, 'Y:m:d H:i'))->toBe('2020:06:09 12:00');
});
