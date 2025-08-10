<?php

use OhDear\PhpSdk\Enums\CronType;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\CreateCronCheckDefinitionRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\DeleteCronCheckDefinitionRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\GetCronCheckDefinitionsRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\SnoozeCronCheckDefinitionRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\UnsnoozeCronCheckDefinitionRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\UpdateCronCheckDefinitionRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get cron check definitions', function () {
    MockClient::global([
        GetCronCheckDefinitionsRequest::class => MockResponse::fixture('cron-check-definitions'),
    ]);

    $cronCheckDefinitions = $this->ohDear->cronCheckDefinitions(82060);

    foreach ($cronCheckDefinitions as $cronCheckDefinition) {
        expect($cronCheckDefinition->id)->toBeInt();
        expect($cronCheckDefinition->uuid)->toBeString();
        expect($cronCheckDefinition->name)->toBeString();
        expect($cronCheckDefinition->type)->toBeString();
        expect($cronCheckDefinition->ping_url)->toBeString();
        expect($cronCheckDefinition->created_at)->toBeString();
        expect($cronCheckDefinition->latest_result_label)->toBeString();
        expect($cronCheckDefinition->latest_result_label_color)->toBeString();
        expect($cronCheckDefinition->human_readable_latest_ping_at)->toBeString();
        expect($cronCheckDefinition->human_readable_cron_expression)->toBeString();
    }
});

it('can create a cron check definition', function () {
    MockClient::global([
        CreateCronCheckDefinitionRequest::class => MockResponse::fixture('create-cron-check-definition'),
    ]);

    $cronCheckDefinition = $this->ohDear->createCronCheckDefinition(82060, [
        'name' => 'Test Cron Check',
        'type' => CronType::Simple,
        'frequency_in_minutes' => 60,
        'grace_time_in_minutes' => 10,
        'description' => 'Test cron check description',
    ]);

    expect($cronCheckDefinition->id)->toBeInt();
    expect($cronCheckDefinition->name)->toBeString();
    expect($cronCheckDefinition->type)->toBeString();
    expect($cronCheckDefinition->ping_url)->toBeString();
});

it('can update a cron check definition', function () {
    MockClient::global([
        UpdateCronCheckDefinitionRequest::class => MockResponse::fixture('update-cron-check-definition'),
    ]);

    $cronCheckDefinition = $this->ohDear->updateCronCheckDefinition(208283, [
        'name' => 'Updated Cron Check',
        'type' => CronType::Simple,
        'frequency_in_minutes' => 120,
        'grace_time_in_minutes' => 15,
    ]);

    expect($cronCheckDefinition->id)->toBeInt();
    expect($cronCheckDefinition->name)->toBeString();
    expect($cronCheckDefinition->type)->toBeString();
});

it('can delete a cron check definition', function () {
    MockClient::global([
        DeleteCronCheckDefinitionRequest::class => MockResponse::make(),
    ]);

    $this->ohDear->deleteCronCheckDefinition(208283);

    markTestComplete();
});

it('can snooze a cron check definition', function () {
    MockClient::global([
        SnoozeCronCheckDefinitionRequest::class => MockResponse::fixture('snooze-cron-check-definition'),
    ]);

    $cronCheckDefinition = $this->ohDear->snoozeCronCheckDefinition(208283, 60);

    expect($cronCheckDefinition->id)->toBeInt();
    expect($cronCheckDefinition->name)->toBeString();
});

it('can unsnooze a cron check definition', function () {
    MockClient::global([
        UnsnoozeCronCheckDefinitionRequest::class => MockResponse::fixture('unsnooze-cron-check-definition'),
    ]);

    $cronCheckDefinition = $this->ohDear->unsnoozeCronCheckDefinition(208283);

    expect($cronCheckDefinition->id)->toBeInt();
    expect($cronCheckDefinition->name)->toBeString();
});
