<?php

use OhDear\PhpSdk\Requests\Tags\CreateTagRequest;
use OhDear\PhpSdk\Requests\Tags\GetTagsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get tags', function () {
    MockClient::global([
        GetTagsRequest::class => MockResponse::fixture('tags'),
    ]);

    $tags = $this->ohDear->tags();

    expect($tags)->toBeArray();
    foreach ($tags as $tag) {
        expect($tag->id)->toBeInt();
        expect($tag->name)->toBeString();
    }
});

it('can create a tag', function () {
    MockClient::global([
        CreateTagRequest::class => MockResponse::fixture('create-tag'),
    ]);

    $tag = $this->ohDear->createTag([
        'name' => 'staging',
        'team_id' => 19245,
    ]);

    expect($tag->id)->toBe(2);
    expect($tag->name)->toBe('staging');
});
