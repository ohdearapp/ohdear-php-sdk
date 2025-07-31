<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\CertificateHealth;

trait ManagesCertificateHealth
{
    public function certificateHealth(int $monitorId)
    {
        return new CertificateHealth($this->get("certificate-health/{$monitorId}"));
    }
}
