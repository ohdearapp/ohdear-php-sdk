<?php

use OhDear\PhpSdk\Requests\StatusPages\CreateStatusPageUpdateTemplateRequest;
use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageUpdateTemplateRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPageUpdateTemplatesRequest;
use OhDear\PhpSdk\Requests\StatusPages\UpdateStatusPageUpdateTemplateRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get status page update templates', function () {
    MockClient::global([
        GetStatusPageUpdateTemplatesRequest::class => MockResponse::fixture('status-page-update-templates'),
    ]);

    $templates = $this->ohDear->statusPageUpdateTemplates();

    expect($templates)->toBeArray();
    foreach ($templates as $template) {
        expect($template->id)->toBeInt();
        expect($template->name)->toBeString();
    }
});

it('can create a status page update template', function () {
    MockClient::global([
        CreateStatusPageUpdateTemplateRequest::class => MockResponse::fixture('create-status-page-update-template'),
    ]);

    $template = $this->ohDear->createStatusPageUpdateTemplate([
        'name' => 'Incident Template',
        'title' => 'Service Incident',
        'text' => 'We are investigating an issue.',
        'severity' => 'high',
    ]);

    expect($template->id)->toBe(2);
    expect($template->name)->toBe('Incident Template');
    expect($template->severity)->toBe('high');
});

it('can update a status page update template', function () {
    MockClient::global([
        UpdateStatusPageUpdateTemplateRequest::class => MockResponse::fixture('update-status-page-update-template'),
    ]);

    $template = $this->ohDear->updateStatusPageUpdateTemplate(1, [
        'name' => 'Updated Template',
    ]);

    expect($template->id)->toBe(1);
    expect($template->name)->toBe('Updated Template');
});

it('can delete a status page update template', function () {
    MockClient::global([
        DeleteStatusPageUpdateTemplateRequest::class => MockResponse::fixture('delete-status-page-update-template'),
    ]);

    $this->ohDear->deleteStatusPageUpdateTemplate(1);

    markTestComplete();
});
