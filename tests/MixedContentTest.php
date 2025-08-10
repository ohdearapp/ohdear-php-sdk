<?php

use OhDear\PhpSdk\Requests\MixedContent\GetMixedContentRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get mixed content issues', function () {
    MockClient::global([
        GetMixedContentRequest::class => MockResponse::fixture('mixed-content'),
    ]);

    $mixedContentItems = $this->ohDear->mixedContent(82060);

    expect($mixedContentItems)->toBeArray();

    foreach ($mixedContentItems as $mixedContent) {
        expect($mixedContent->element_name)->toBeString();
        expect($mixedContent->mixed_content_url)->toBeString();
        expect($mixedContent->found_on_url)->toBeString();
    }
});