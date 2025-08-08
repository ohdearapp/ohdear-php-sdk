<?php

use OhDear\PhpSdk\Requests\MeRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('can get the current user', function() {
    MockClient::global([
        MeRequest::class => MockResponse::fixture('me'),
    ]);

    $user = $this->ohDear->me();

    expect($user->email)->toBe('freek@ohdear.app');
});
