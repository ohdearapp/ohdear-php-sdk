<?php

namespace OhDear\PhpSdk\Tests;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use OhDear\PhpSdk\OhDear;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected OhDear $ohDear;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadEnvironmentVariables();

        $apiToken = env('API_TOKEN');

        $client = new Client([
            'base_uri' => env('OH_DEAR_API_URL', 'https://ohdear.app.test/api/'),
            'verify' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => "Bearer {$apiToken}",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        $this->ohDear = new OhDear($apiToken);

        $this->ohDear->setClient($client);
    }

    protected function loadEnvironmentVariables(): void
    {
        if (! file_exists(__DIR__.'/../.env')) {
            return;
        }

        $dotEnv = Dotenv::createImmutable(__DIR__.'/..');

        $dotEnv->load();
    }

    public function ensureApiTokenPresent(): void
    {
        if (! env('API_TOKEN')) {
            $this->markTestSkipped('No API token found');
        }
    }
}
