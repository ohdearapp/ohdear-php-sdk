<?php

namespace OhDear\PhpSdk\Resources;

class Domain extends ApiResource
{
    public string $expiresAt;

    public string $registeredAt;

    public string $lastChangedAt;

    public string $lastUpdatedInRdapDbAt;

    /** @var array<string, bool> */
    public array $domainStatuses;

    public array $rdapDomainResponse;

    public string $createdAt;
}
