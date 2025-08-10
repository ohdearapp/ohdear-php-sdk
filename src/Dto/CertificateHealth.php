<?php

namespace OhDear\PhpSdk\Dto;

class CertificateHealth
{
    public function __construct(
        public array $certificate_details,
        public array $certificate_checks,
        public array $certificate_chain_issuers,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            certificate_details: $data['certificate_details'] ?? [],
            certificate_checks: $data['certificate_checks'] ?? [],
            certificate_chain_issuers: $data['certificate_chain_issuers'] ?? [],
        );
    }

    /**
     * Get certificate issuer
     */
    public function getIssuer(): ?string
    {
        return $this->certificate_details['issuer'] ?? null;
    }

    /**
     * Get certificate valid from date
     */
    public function getValidFrom(): ?string
    {
        return $this->certificate_details['valid_from'] ?? null;
    }

    /**
     * Get certificate valid until date
     */
    public function getValidUntil(): ?string
    {
        return $this->certificate_details['valid_until'] ?? null;
    }

    /**
     * Check if a specific certificate check passed
     */
    public function checkPassed(string $checkType): bool
    {
        foreach ($this->certificate_checks as $check) {
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
        return array_filter($this->certificate_checks, fn ($check) => ! ($check['passed'] ?? false));
    }

    /**
     * Check if certificate is healthy (all checks passed)
     */
    public function isHealthy(): bool
    {
        return empty($this->getFailedChecks());
    }
}
