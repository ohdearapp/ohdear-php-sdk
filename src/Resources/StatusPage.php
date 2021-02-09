<?php

namespace OhDear\PhpSdk\Resources;

class StatusPage extends ApiResource
{
    public int $id;

    public string $title;

    public string $domain;

    public string $slug;

    public string $fullUrl;

    public string $timezone;

    public string $summarizedStatus;

    public function updates(): array
    {
        return $this->ohDear->statusPageUpdates($this->id);
    }
}
