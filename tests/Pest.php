<?php

use Dotenv\Dotenv;
use OhDear\PhpSdk\OhDear;
use Saloon\Http\Faking\MockClient;

uses()
    ->beforeEach(function () {

        $dotenv = Dotenv::createImmutable(__DIR__.'/TestSupport');
        $dotenv->safeLoad();

        $this->token = $_ENV['OH_DEAR_API_TOKEN'] ?? 'fake-token';
        $this->baseUrl = $_ENV['OH_DEAR_BASE_URL'] ?? 'https://ohdear.app/api/';

        $this->ohDear = new OhDear($this->token, $this->baseUrl);

        MockClient::destroyGlobal();
    })
    ->in(__DIR__);
