<?php

use OhDear\PhpSdk\OhDear;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\MockConfig;

uses()->in(__DIR__);

Config::preventStrayRequests();
MockConfig::throwOnMissingFixtures();

function ohDearMock(): OhDear
{
    MockClient::destroyGlobal();

    return new OhDear('fake-token', 'https://ohdear.app/api/');
}

function markTestComplete()
{
    expect(true)->toBeTrue();
}
