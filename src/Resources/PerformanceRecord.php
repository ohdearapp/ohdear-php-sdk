<?php

namespace OhDear\PhpSdk\Resources;

class PerformanceRecord extends ApiResource
{
    public int $id;
    public int $siteId;
    public string $createdAt;

    public float $dnsTimeInSeconds;
    public float $tcpTimeInSeconds;
    public float $sslHandshakeTimeInSeconds;
    public float $remoteServerProcessingTimeInSeconds;
    public float $downloadTimeInSeconds;
    public float $totalTimeInSeconds;

    public array $curl;

    /** @deprecated */
    public float $timeNamelookup;

    /** @deprecated */
    public float $timeConnect;

    /** @deprecated */
    public float $timeAppconnect;

    /** @deprecated */
    public float $timePretransfer;

    /** @deprecated */
    public float $timeRemoteserver;

    /** @deprecated */
    public float $timeRedirect;

    /** @deprecated */
    public float $timeDownload;

    /** @deprecated */
    public float $timeTotal;
}
