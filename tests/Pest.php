<?php

use Dotenv\Dotenv;
use OhDear\PhpSdk\OhDear;
use Saloon\Http\Faking\MockClient;

uses()->in(__DIR__);

function ohDearMock(): OhDear
{
    MockClient::destroyGlobal();

    $dotenv = Dotenv::createImmutable(__DIR__.'/TestSupport');
    $dotenv->safeLoad();

    $token = $_ENV['OH_DEAR_API_TOKEN'] ?? 'fake-token';
    $baseUrl = $_ENV['OH_DEAR_BASE_URL'] ?? 'https://ohdear.app/api/';

    return new OhDear($token, $baseUrl);
}

function markTestComplete()
{
    expect(true)->toBeTrue();
}
