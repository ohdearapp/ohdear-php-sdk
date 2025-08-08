<?php

use Dotenv\Dotenv;
use OhDear\PhpSdk\OhDear;
use OhDear\PhpSdk\Requests\Monitors\GetMonitorsRequest;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../tests/TestSupport');
$dotenv->safeLoad();

$token = $_ENV['OH_DEAR_API_TOKEN'] ?? null;
$baseUrl = $_ENV['OH_DEAR_BASE_URL'] ?? null;

$ohDear = new OhDear($token, $baseUrl);

$monitors = $ohDear->monitors(teamId:1);

foreach($monitors as $monitor) {
    dump($monitor->teamId);
}