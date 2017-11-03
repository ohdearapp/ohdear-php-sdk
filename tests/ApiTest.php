<?php

namespace Tests;

use GuzzleHttp\Client;
use OhDear\PhpSdk\OhDear;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    /** @test */
    public function it_tests()
    {
        //production
        //$apiKey = 'H3VPxvHDyAQ8zMr3WxIrUJHoZsImk0TQMffp9rrpe7xBwbc9332mGqUXTqkX';

        //test
        $apiKey = 'c2nh018eM1pTjqfbuF90ILuscZwlBISVPj7tJB8laoWS1Sg2jgf8FBlIIkgB';

        $testClient = new Client([
            'base_uri' => 'http://ohdearapp.com.dev/api/',
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);

        $ohDear = new OhDear($apiKey, $testClient);

        var_dump($site = $ohDear->site(2));
$site->delete();
die();
        $this->info('creating site https://newsite.com');
        $ohDear->createSite(['url' => 'https://newsite.com', 'team_id' => 2]);
        $this->info('done');
    }
}