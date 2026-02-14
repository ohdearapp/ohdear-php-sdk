<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\StatusPageUpdateTemplate;
use OhDear\PhpSdk\Requests\StatusPages\CreateStatusPageUpdateTemplateRequest;
use OhDear\PhpSdk\Requests\StatusPages\DeleteStatusPageUpdateTemplateRequest;
use OhDear\PhpSdk\Requests\StatusPages\GetStatusPageUpdateTemplatesRequest;
use OhDear\PhpSdk\Requests\StatusPages\UpdateStatusPageUpdateTemplateRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsStatusPageUpdateTemplateEndpoints
{
    public function statusPageUpdateTemplates(): array
    {
        $request = new GetStatusPageUpdateTemplatesRequest();

        return $this->send($request)->dtoOrFail();
    }

    public function createStatusPageUpdateTemplate(array $data): StatusPageUpdateTemplate
    {
        $request = new CreateStatusPageUpdateTemplateRequest($data);

        return $this->send($request)->dto();
    }

    public function updateStatusPageUpdateTemplate(int $id, array $data): StatusPageUpdateTemplate
    {
        $request = new UpdateStatusPageUpdateTemplateRequest($id, $data);

        return $this->send($request)->dto();
    }

    public function deleteStatusPageUpdateTemplate(int $id): self
    {
        $request = new DeleteStatusPageUpdateTemplateRequest($id);

        $this->send($request);

        return $this;
    }
}
