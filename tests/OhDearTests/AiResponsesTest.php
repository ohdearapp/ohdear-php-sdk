<?php

use OhDear\PhpSdk\Requests\AiResponses\GetAiResponseRequest;
use OhDear\PhpSdk\Requests\AiResponses\GetAiResponsesRequest;
use OhDear\PhpSdk\Requests\AiResponses\GetLatestAiResponseRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get ai responses', function () {
    MockClient::global([
        GetAiResponsesRequest::class => MockResponse::fixture('ai-responses'),
    ]);

    $responses = $this->ohDear->aiResponses(82060);

    expect($responses)->toBeArray();
    foreach ($responses as $response) {
        expect($response->id)->toBeInt();
        expect($response->result)->toBe('ok');
        expect($response->text)->toBeString();
    }
});

it('can get a single ai response', function () {
    MockClient::global([
        GetAiResponseRequest::class => MockResponse::fixture('ai-response'),
    ]);

    $response = $this->ohDear->aiResponse(82060, 1);

    expect($response->id)->toBe(1);
    expect($response->result)->toBe('ok');
    expect($response->finishReason)->toBe('stop');
    expect($response->prompt)->toBeString();
    expect($response->text)->toBeString();
});

it('can get the latest ai response', function () {
    MockClient::global([
        GetLatestAiResponseRequest::class => MockResponse::fixture('latest-ai-response'),
    ]);

    $response = $this->ohDear->latestAiResponse(82060);

    expect($response->id)->toBe(1);
    expect($response->result)->toBe('ok');
    expect($response->rawResponse)->toBeString();
});
