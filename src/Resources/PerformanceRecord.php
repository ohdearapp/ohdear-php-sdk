<?php

namespace OhDear\PhpSdk\Resources;

class PerformanceRecord extends ApiResource
{
    public int $id;

    public int $siteId;

    public string $createdAt;

    /*
     * The time spent doing the DNS lookup.
     */
    public float $timeNamelookup;

    /*
     * The time spent doing the TCP three-way handshake.
     */
    public float $timeConnect;

    /*
     * The time spent doing the TLS handshake.
     */
    public float $timeAppconnect;

    public float $timePretransfer;

    /*
     * The time the server took to send the first byte (TTFB or Remote Server Processing).
     */
    public float $timeRemoteserver;

    public float $timeRedirect;
    public float $timeDownload;

    /*
     * The total time it took to load the website, from start to very finish.
     */
    public float $timeTotal;
}
