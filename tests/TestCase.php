<?php

namespace OhDear\PhpSdk\Tests;

use GuzzleHttp\Client;
use OhDear\PhpSdk\OhDear;
use \PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{


    public function setUp(): void
    {
        parent::setUp();

        $apiToken = env('API_TOKEN');

        $client = new Client([
            'base_uri' => env('BASE_URI', 'https://ohdear.app.test/api/'),
            'http_errors' => false,
            'headers' => [
                'Authorization' => "Bearer {$apiToken}",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        $this->ohDear = new OhDear($apiToken, $client);
    }

    protected function loadEnvironmentVariables()
    {
        if (!file_exists(__DIR__ . '/../.env')) {
            return;
        }

        $dotEnv = Dotenv::createImmutable(__DIR__ . '/..');

        $dotEnv->load();
    }
}
