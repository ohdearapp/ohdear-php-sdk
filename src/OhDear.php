<?php

namespace OhDear\PhpSdk;

use GuzzleHttp\Client;
use OhDear\PhpSdk\Actions\ManagesSites;
use OhDear\PhpSdk\Actions\ManagesUsers;
use OhDear\PhpSdk\Actions\ManagesChecks;
use OhDear\PhpSdk\Actions\ManagesBrokenLinks;
use OhDear\PhpSdk\Actions\ManagesMixedContent;

class OhDear
{
    use MakesHttpRequests,
        ManagesSites,
        ManagesChecks,
        ManagesUsers,
        ManagesBrokenLinks,
        ManagesMixedContent;

    /** @var string */
    public $apiToken;

    /** @var \GuzzleHttp\Client */
    public $client;

    public function __construct(string $apiToken, Client $client = null)
    {
        $this->apiToken = $apiToken;

        $this->client = $client ?: new Client([
            'base_uri' => 'https://ohdear.app/api/',
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    protected function transformCollection(array $collection, string $class): array
    {
        return array_map(function ($attributes) use ($class) {
            return new $class($attributes, $this);
        }, $collection);
    }
}
