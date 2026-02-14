<?php

use OhDear\PhpSdk\Requests\TagGroups\CreateTagGroupRequest;
use OhDear\PhpSdk\Requests\TagGroups\DeleteTagGroupRequest;
use OhDear\PhpSdk\Requests\TagGroups\GetTagGroupsRequest;
use OhDear\PhpSdk\Requests\TagGroups\UpdateTagGroupRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get tag groups', function () {
    MockClient::global([
        GetTagGroupsRequest::class => MockResponse::fixture('tag-groups'),
    ]);

    $tagGroups = $this->ohDear->tagGroups();

    expect($tagGroups)->toBeArray();
    foreach ($tagGroups as $tagGroup) {
        expect($tagGroup->id)->toBeInt();
        expect($tagGroup->label)->toBeString();
    }
});

it('can create a tag group', function () {
    MockClient::global([
        CreateTagGroupRequest::class => MockResponse::fixture('create-tag-group'),
    ]);

    $tagGroup = $this->ohDear->createTagGroup([
        'label' => 'Region',
        'team_id' => 19245,
    ]);

    expect($tagGroup->id)->toBe(2);
    expect($tagGroup->label)->toBe('Region');
});

it('can update a tag group', function () {
    MockClient::global([
        UpdateTagGroupRequest::class => MockResponse::fixture('update-tag-group'),
    ]);

    $tagGroup = $this->ohDear->updateTagGroup(1, [
        'label' => 'Updated Environment',
    ]);

    expect($tagGroup->id)->toBe(1);
    expect($tagGroup->label)->toBe('Updated Environment');
});

it('can delete a tag group', function () {
    MockClient::global([
        DeleteTagGroupRequest::class => MockResponse::fixture('delete-tag-group'),
    ]);

    $this->ohDear->deleteTagGroup(1);

    markTestComplete();
});
