<?php

use Dotenv\Dotenv;
use OhDear\PhpSdk\OhDear;

require_once __DIR__.'/../../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->safeLoad();

$token = $_ENV['OH_DEAR_API_TOKEN'] ?? null;
$baseUrl = $_ENV['OH_DEAR_BASE_URL'] ?? null;

$ohDear = new OhDear($token, $baseUrl);

/*
dump($ohDear->me());

$updated = $ohDear->updateMonitor(82063, [
    'uptime_check_settings' => [
        'look_for_string' => 'a string',
    ],
]);

dd($updated);

$monitors = $ohDear->monitors();


foreach ($monitors as $monitor) {
    // dump($monitor->teamId);
    // dump($monitor->id);
}

// dump($ohDear->monitor(82062));

*/

$monitor = $ohDear->createMonitor([
    'team_id' => 19245,
    'type' => 'http',
    'url' => 'https://laravel.com',
]);

dump($monitor);
