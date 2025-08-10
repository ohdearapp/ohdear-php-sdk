<?php

namespace OhDear\PhpSdk\Enums;

enum CheckType: string
{
    case Uptime = 'uptime';
    case Performance = 'performance';
    case CertificateHealth = 'certificate_health';
    case BrokenLinks = 'broken_links';
    case MixedContent = 'mixed_content';
    case Lighthouse = 'lighthouse';
    case Cron = 'cron';
    case ApplicationHealth = 'application_health';
    case Sitemap = 'sitemap';
    case Dns = 'dns';
    case Domain = 'domain';
}