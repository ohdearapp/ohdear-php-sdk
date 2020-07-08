<?php

namespace OhDear\PhpSdk\Resources;

class PerformanceRecord extends ApiResource
{
    public int $id;

    public int $siteId;

    /*
     * The time spent doing the DNS lookup.
     */
    public int $timeNamelookup;

    /*
     * The time spent doing the TCP three-way handshake.
     */
    public $timeConnect;

    /*
     * The time spent doing the TLS handshake.
     */
    public int $timeAppconnect;

    /*
     * The time the server took to send the first byte (TTFB or Remote Server Processing).
     */
    public int $timeRemoteserver;

    /*
     * The total time it took to load the website, from start to very finish.
     */
    public int $timeTotal;
}
