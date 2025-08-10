<?php

namespace OhDear\PhpSdk\Dto;

class CertificateHealth
{
    public function __construct(
        public array $certificateDetails,
        public array $certificateChecks,
        public array $certificateChainIssuers,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            certificateDetails: $data['certificate_details'] ?? [],
            certificateChecks: $data['certificate_checks'] ?? [],
            certificateChainIssuers: $data['certificate_chain_issuers'] ?? [],
        );
    }

    /**
     * Get certificate issuer
     */
    public function getIssuer(): ?string
    {
        return $this->certificateDetails['issuer'] ?? null;
    }

    /**
     * Get certificate valid from date
     */
    public function getValidFrom(): ?string
    {
        return $this->certificateDetails['valid_from'] ?? null;
    }

    /**
     * Get certificate valid until date
     */
    public function getValidUntil(): ?string
    {
        return $this->certificateDetails['valid_until'] ?? null;
    }

    /**
     * Check if a specific certificate check passed
     */
    public function checkPassed(string $checkType): bool
    {
        foreach ($this->certificateChecks as $check) {
            if (($check['type'] ?? '') === $checkType) {
                return $check['passed'] ?? false;
            }
        }

        return false;
    }

    /**
     * Get all failed certificate checks
     */
    public function getFailedChecks(): array
    {
        return array_filter($this->certificateChecks, fn ($check) => ! ($check['passed'] ?? false));
    }

    /**
     * Check if certificate is healthy (all checks passed)
     */
    public function isHealthy(): bool
    {
        return empty($this->getFailedChecks());
    }
}
