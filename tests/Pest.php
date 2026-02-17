<?php

use OhDear\PhpSdk\OhDear;
use Saloon\Http\Faking\MockClient;

uses()->in(__DIR__);

function ohDearMock(): OhDear
{
    MockClient::destroyGlobal();

    return new OhDear('fake-token', 'https://ohdear.app/api/');
}

function markTestComplete()
{
    expect(true)->toBeTrue();
}
