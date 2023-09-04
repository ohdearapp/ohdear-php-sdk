<?php

namespace OhDear\PhpSdk\Resources;

class StatusPageUpdate extends ApiResource
{
    public int $id;

    public string $title;

    public ?string $text;

    public bool $pinned;

    public string $severity;

    public string $time;

    public string $statusPageUrl;

    public function delete(): void
    {
        $this->ohDear->deleteStatusPageUpdate($this->id);
    }
}
