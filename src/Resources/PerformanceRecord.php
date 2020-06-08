<?php

namespace OhDear\PhpSdk\Resources;

class PerformanceRecord extends ApiResource
{
    /**
     * The id of the performance record.
     *
     * @var int
     */
    public $id;

    /**
     * The site ID to which it belongs.
     *
     * @var int
     */
    public $siteId;

    /**
     * The time spent doing the DNS lookup.
     *
     * @var int
     */
    public $timeNamelookup;

    /**
     * The time spent doing the TCP three-way handshake.
     *
     * @var int
     */
    public $timeConnect;

    /**
     * The time spent doing the TLS handshake.
     *
     * @var int
     */
    public $timeAppconnect;

    /**
     * The time the server took to send the first byte (TTFB or Remote Server Processing)
     *
     * @var int
     */
    public $timeRemoteserver;

    /**
     * The total time it took to load the website, from start to very finish
     *
     * @var int
     */
    public $timeTotal;
}
