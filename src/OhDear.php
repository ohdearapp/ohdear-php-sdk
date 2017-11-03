<?php

namespace OhDear\PhpSdk;

use GuzzleHttp\Client;
use OhDear\PhpSdk\Actions\ManagesChecks;
use OhDear\PhpSdk\Actions\ManagesSites;

class OhDear
{
    use MakesHttpRequests,
        ManagesSites,
        ManagesChecks;

    /** @var string */
    public $apiKey;

    /** @var \GuzzleHttp\Client */
    public $client;

    public function __construct(string $apiKey, Client $client = null)
    {
        $this->apiKey = $apiKey;

        $this->client = $client ?: new Client([
            'base_uri' => 'https://ohdearapp.com/api/',
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    protected function transformCollection(array $collection, string $class, array $extraData = []): array
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }
}