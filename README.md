# Oh Dear PHP SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)
![Tests](https://github.com/ohdearapp/ohdear-php-sdk/workflows/run-tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/ohdearapp/ohdear-php-sdk.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/ohdear-php-sdk)

This package is the official PHP SDK for the [Oh Dear](https://ohdear.app) API, built with [Saloon](https://docs.saloon.dev/) v3.

```php
use OhDear\PhpSdk\OhDear;
use OhDear\PhpSdk\Dto\Monitor;
use OhDear\PhpSdk\Requests\Monitors\{GetMonitorsRequest, CreateMonitorRequest};

$ohDear = new OhDear('your-api-token');

$ohDear->createMonitor([
    'url' => 'https://example.com',
    'type' => 'http',
    'team_id' => 1,
])

// returns an iterator of OhDear\PhpSdk\Dto\Monitor
$monitors = $ohDear->monitors();

foreach($monitors as $monitor) {
    echo "Monitor: {$monitor->url} (ID: {$monitor->id})\n";
}
```

Behind the scenes, the SDK uses [Saloon](https://docs.saloon.dev) to make the HTTP requests.

## Installation

```bash
composer require ohdearapp/ohdear-php-sdk
```

## Oh Dear documentation

To get started, we highly recommend reading
the [Oh Dear API documentation](https://ohdear.app/docs/integrations/the-oh-dear-api).

## Usage

To authenticate, you'll need an API token. You can create one in
the [API tokens screen at Oh Dear](https://ohdear.app/user/api-tokens).

```php
use OhDear\PhpSdk\OhDear;

$ohDear = new OhDear('your-api-token');
```

### Setting a timeout

By default, the SDK will wait for a response from Oh Dear for 10 seconds. You can change this by passing a `timeoutInSeconds` option to the constructor:

```php
$ohDear = new OhDear('your-api-token', timeoutInSeconds: 30);
```


### Handling errors

The SDK will throw an exception if the API returns an error. For validation errors, the SDK will throw a `ValidationException`.

```php
try {
    $ohDear->createMonitor([
        'url' => 'invalid-url',
    ]);
} catch (\OhDear\PhpSdk\Exceptions\ValidationException $exception) {
    $exception->getMessage(); // returns a string describing the errors
    
    $exception->errors(); // returns an array with all validation errors
}
```

For all other errors, the SDK will throw an `\OhDear\PhpSdk\Exceptions\OhDearException`.

### Get user info

```php
// returns OhDear\PhpSdk\Dto\User
$user = $ohDear->me();

echo $user->email; // returns the email address of the authenticated user
```

### Monitors

Monitors are the core of Oh Dear - they watch your websites, APIs, and services for uptime, performance, SSL certificates, broken links, and more. You can create different types of monitors (HTTP, ping, TCP) and configure various checks for each one.

#### Get all monitors

```php
// returns an iterator of OhDear\PhpSdk\Dto\Monitor
$monitors = $ohDear->monitors();

foreach($monitors as $monitor) {
    echo "Monitor: {$monitor->url} (ID: {$monitor->id})\n";
}
```

#### Create a monitor

You can use the `createMonitor` method to create a monitor.

```php 
$monitor = $ohDear->createMonitor([
    'url' => 'https://example.com',
    'type' => 'http',
    'team_id' => 1,
]);

echo $monitor->url; // returns https://example.com
```

You can find a list of attributes you can pass to the `createMonitor` method in the [Oh Dear API documentation](#oh-dear-documentation).

#### Getting a single monitor

You can use the `monitor` method to get a single monitor.

```php
// returns OhDear\PhpSdk\Dto\Monitor
$monitor = $ohDear->monitor($monitorId);
```

#### Deleting a monitor

You can use the `deleteMonitor` method to delete a monitor.

```php
$ohDear->deleteMonitor($monitorId);
```

#### Getting a check summary for a monitor

You can get a summary of a specific check type for a monitor, which provides the current status and a human-readable summary:

```php
use OhDear\PhpSdk\Enums\CheckType;

// returns OhDear\PhpSdk\Dto\CheckSummary
$checkSummary = $ohDear->checkSummary($monitorId, CheckType::CertificateHealth);

echo "Check result: {$checkSummary->result}\n";
echo "Summary: {$checkSummary->summary}\n";
```

You can request a summary for all available cases in the `CheckType` enum.`

#### Getting certificate health for a monitor

You can get detailed certificate health information including certificate details, validation checks, and certificate chain:

```php
// returns OhDear\PhpSdk\Dto\CertificateHealth
$certificateHealth = $ohDear->certificateHealth($monitorId);

// Certificate details
echo "Issuer: {$certificateHealth->getIssuer()}\n";
echo "Valid from: {$certificateHealth->getValidFrom()}\n";
echo "Valid until: {$certificateHealth->getValidUntil()}\n";

// Overall health status
echo "Certificate healthy: " . ($certificateHealth->isHealthy() ? 'Yes' : 'No') . "\n";

// Check specific validations
echo "Domain matches: " . ($certificateHealth->checkPassed('domain_matches') ? 'Yes' : 'No') . "\n";
echo "Not expired: " . ($certificateHealth->checkPassed('not_expired') ? 'Yes' : 'No') . "\n";

// Get failed checks
$failedChecks = $certificateHealth->getFailedChecks();
if (!empty($failedChecks)) {
    echo "Failed checks:\n";
    foreach ($failedChecks as $check) {
        echo "- {$check['label']} ({$check['type']})\n";
    }
}

// Certificate chain issuers
echo "Certificate chain:\n";
foreach ($certificateHealth->certificateChainIssuers as $issuer) {
    echo "- $issuer\n";
}
```

### Status pages

Status pages provide a public way to communicate the status of your services to your users. They automatically reflect the health of your monitors and allow you to post updates during incidents or maintenance windows.

#### Get all status pages

```php
// returns an iterator of OhDear\PhpSdk\Dto\StatusPage
$statusPages = $ohDear->statusPages();

foreach($statusPages as $statusPage) {
    echo "Status Page: {$statusPage->title} (ID: {$statusPage->id})\n";
}
```

#### Getting a single status page

You can use the `statusPage` method to get a single status page.

```php
// returns OhDear\PhpSdk\Dto\StatusPage
$statusPage = $ohDear->statusPage($statusPageId);
```

#### Deleting a status page

You can use the `deleteStatusPage` method to delete a status page.

```php
$ohDear->deleteStatusPage($statusPageId)
```

### Checks

Checks are individual monitoring tasks that belong to monitors (like uptime, SSL certificate, performance, broken links, etc.). You can control each check independently - enabling, disabling, requesting immediate runs, and temporarily snoozing notifications.

#### Enabling a check

You can enable a check using its ID:

```php
// Returns OhDear\PhpSdk\Dto\Check
$check = $ohDear->enableCheck($checkId);

echo $check->enabled; // true
```

#### Disabling a check

You can disable a check using its ID:

```php
// Returns OhDear\PhpSdk\Dto\Check
$check = $ohDear->disableCheck($checkId);

echo $check->enabled;
```

#### Requesting a check run

You can request an immediate run of a check:

```php
// Basic run request
// Returns OhDear\PhpSdk\Dto\Check
$check = $ohDear->requestCheckRun($checkId);

// For uptime checks, you can also pass custom HTTP headers
$check = $ohDear->requestCheckRun($checkId, [
    'User-Agent' => 'Custom User Agent',
    'Authorization' => 'Bearer token123',
]);
```

#### Snoozing a check

You can snooze a check for a specified number of minutes (1 to 144000 minutes):

```php
// Snooze a check for 60 minutes
$check = $ohDear->snoozeCheck($checkId, 60);

echo $check->activeSnooze ? 'Check is snoozed' : 'Check is active';
```

#### Unsnoozing a check

You can unsnooze a check to make it active again:

```php
$check = $ohDear->unsnoozeCheck($checkId);

echo $check->activeSnooze ? 'Check is still snoozed' : 'Check is now active';
```

### Maintenance Periods

Maintenance periods allow you to temporarily disable notifications for monitors during planned maintenance windows.

#### Getting maintenance periods for a monitor

You can get all maintenance periods for a specific monitor:

```php
// returns an iterator of OhDear\PhpSdk\Dto\MaintenancePeriod
$maintenancePeriods = $ohDear->maintenancePeriods($monitorId);

foreach ($maintenancePeriods as $period) {
    echo "Maintenance: {$period->name} from {$period->startsAt} to {$period->endsAt}\n";
}

// You can also filter by date range
$periods = $ohDear->maintenancePeriods($monitorId, '2024-01-01 00:00:00', '2024-12-31 23:59:59');
```

#### Starting a maintenance period

You can start an immediate maintenance period for a monitor:

```php
// Start maintenance for 1 hour (3600 seconds) - default duration
$period = $ohDear->startMaintenancePeriod($monitorId);

// Start maintenance for a custom duration with a name
$period = $ohDear->startMaintenancePeriod($monitorId, 7200, 'Database Migration');

echo "Maintenance started: {$period->name}";
```

#### Stopping maintenance periods

You can stop all active maintenance periods for a monitor:

```php
$ohDear->stopMaintenancePeriod($monitorId);
```

#### Creating a scheduled maintenance period

You can create a maintenance period scheduled for the future:

```php
$period = $ohDear->createMaintenancePeriod([
    'monitor_id' => $monitorId,
    'name' => 'Scheduled Server Maintenance',
    'starts_at' => '2024-12-25 02:00',
    'ends_at' => '2024-12-25 06:00',
]);

echo "Scheduled maintenance: {$period->name}";
```

#### Updating a maintenance period

You can update an existing maintenance period:

```php
$period = $ohDear->updateMaintenancePeriod($maintenancePeriodId, [
    'name' => 'Updated Maintenance Window',
    'starts_at' => '2024-12-25 01:00',
    'ends_at' => '2024-12-25 05:00',
]);
```

#### Deleting a maintenance period

You can delete a maintenance period:

```php
$ohDear->deleteMaintenancePeriod($maintenancePeriodId);
```

### Uptime Metrics

Uptime metrics provide detailed performance and timing data for your monitors over time. Different monitor types (Http, Ping, TCP) provide different metrics.

#### Getting HTTP uptime metrics

For HTTP monitors, you can get detailed timing metrics including DNS, TCP, SSL handshake times and cURL statistics:

```php
use OhDear\PhpSdk\Enums\UptimeMetricsSplit;

// Get HTTP metrics for the last 24 hours, grouped by hour
$startDate = date('Y-m-d H:i:s', strtotime('-24 hours'));
$endDate = date('Y-m-d H:i:s');

$metrics = $ohDear->httpUptimeMetrics($monitorId, $startDate, $endDate, UptimeMetricsSplit::Hour);

foreach ($metrics as $metric) {
    echo "Date: {$metric->date};
    echo "Total time: {$metric->totalTimeInSeconds}s;
    echo "DNS time: {$metric->dnsTimeInSeconds}s;
    echo "TCP time: {$metric->tcpTimeInSeconds}s;
    echo "SSL handshake: {$metric->sslHandshakeTimeInSeconds}s;
    echo "Download time: {$metric->downloadTimeInSeconds}s;
    echo "cURL total time: {$metric->curl['total_time']}s;
}
```

#### Getting ping uptime metrics

For ping monitors, you can get response times, packet loss, and uptime percentages:

```php
$metrics = $ohDear->pingUptimeMetrics($monitorId, $startDate, $endDate, UptimeMetricsSplit::Hour);

foreach ($metrics as $metric) {
    echo "Date: {$metric->date}";
    echo "Average response time: {$metric->averageTimeInMs}ms";
    echo "Packet loss: {$metric->packetLossPercentage}%";
    echo "Uptime: {$metric->uptimePercentage}%";
    echo "Uptime seconds: {$metric->uptimeSeconds}";
    echo "Downtime seconds: {$metric->downtimeSeconds}";
}
```

#### Getting TCP uptime metrics

For TCP monitors, you can get connection times and uptime data:

```php
$metrics = $ohDear->tcpUptimeMetrics($monitorId, $startDate, $endDate, UptimeMetricsSplit::Hour);

foreach ($metrics as $metric) {
    echo "Date: {$metric->date}";
    echo "Time to connect: {$metric->timeToConnectInMs}ms";
    echo "Uptime: {$metric->uptimePercentage}%";
    echo "Downtime: {$metric->downtimePercentage}%";
}
```

### Cron Check Definitions

Cron check definitions allow you to monitor scheduled tasks and ensure they execute on time. You can create different types of cron checks including traditional cron expressions and simple frequency-based checks.

#### Getting all cron check definitions for a monitor

```php
// returns an iterator of OhDear\PhpSdk\Dto\CronCheckDefinition
$cronCheckDefinitions = $ohDear->cronCheckDefinitions($monitorId);

foreach ($cronCheckDefinitions as $cronCheckDefinition) {
    echo "Cron Check: {$cronCheckDefinition->name} ({$cronCheckDefinition->type})\n";
    echo "Latest result: {$cronCheckDefinition->latestResultLabel}\n";
}
```

#### Creating a cron check definition

You can create frequency-based or cron expression-based checks:

```php
use OhDear\PhpSdk\Enums\CronType;

// Frequency-based cron check (ping every 30 minutes, 5 minute grace period)
$cronCheckDefinition = $ohDear->createCronCheckDefinition($monitorId, [
    'name' => 'Daily Backup',
    'type' => CronType::Simple, // Uses frequency_in_minutes
    'frequency_in_minutes' => 1440, // 24 hours
    'grace_time_in_minutes' => 60,
    'description' => 'Daily database backup task',
]);

// Cron expression-based check
$cronCheckDefinition = $ohDear->createCronCheckDefinition($monitorId, [
    'name' => 'Nightly Reports',
    'type' => CronType::Cron, // Uses cron_expression
    'cron_expression' => '0 2 * * *', // Run at 2:00 AM daily
    'grace_time_in_minutes' => 30,
    'server_timezone' => 'Europe/Brussels',
    'description' => 'Generate nightly reports',
]);

echo $cronCheckDefinition->pingUrl; // URL to ping when task completes
```

#### Updating a cron check definition

```php
$cronCheckDefinition = $ohDear->updateCronCheckDefinition($monitorId, $cronCheckDefinitionId, [
    'name' => 'Updated Backup Task',
    'type' => CronType::Simple,
    'frequency_in_minutes' => 720, // Change to every 12 hours
    'grace_time_in_minutes' => 90,

]);
```

#### Deleting a cron check definition

```php
$ohDear->deleteCronCheckDefinition($cronCheckDefinitionId);
```

#### Snoozing a cron check definition

You can temporarily snooze notifications for a cron check:

```php
// Snooze for 2 hours (120 minutes)
$cronCheckDefinition = $ohDear->snoozeCronCheckDefinition($cronCheckDefinitionId, 120);

echo $cronCheckDefinition->activeSnooze['ends_at'];
```

#### Unsnoozing a cron check definition

```php
$cronCheckDefinition = $ohDear->unsnoozeCronCheckDefinition($cronCheckDefinitionId);
```

### Broken Links

The broken links feature crawls your website and identifies links that return HTTP error status codes, helping you maintain a healthy website.

#### Getting broken links for a monitor

```php
// returns an iterator of OhDear\PhpSdk\Dto\BrokenLink
$brokenLinks = $ohDear->brokenLinks($monitorId);

foreach ($brokenLinks as $brokenLink) {
    echo "Broken link: {$brokenLink->crawledUrl}";
    echo "Status: {$brokenLink->statusCode}";
    echo "Found on: {$brokenLink->foundOnUrl}";
    echo "Link text: {$brokenLink->linkText}";
    echo "Internal link: " . ($brokenLink->internal ? 'Yes' : 'No') . "";
}
```

### Detected Certificates

Detected certificates provide information about SSL certificates that Oh Dear has discovered while monitoring your site, including their details, validity, and fingerprints.

#### Getting all detected certificates for a monitor

```php
// returns an array of OhDear\PhpSdk\Dto\DetectedCertificate
$detectedCertificates = $ohDear->detectedCertificates($monitorId);

foreach ($detectedCertificates as $certificate) {
    echo "Certificate ID: {$certificate->id}";
    echo "Fingerprint: {$certificate->fingerprint}";
    
    if ($certificate->certificateDetails) {
        $details = $certificate->certificateDetails;
        echo "Issuer: {$details['issuer']}";
        echo "Domain: {$details['domain']}";
        echo "Valid from: {$details['valid_from']}";
        echo "Valid until: {$details['valid_until']}";
        echo "Days until expiration: {$details['days_until_expiration']}";
        echo "Is valid: " . ($details['is_valid'] ? 'Yes' : 'No');
        echo "Is expired: " . ($details['is_expired'] ? 'Yes' : 'No');
        
        // Additional domains covered by this certificate
        if (!empty($details['additional_domains'])) {
            echo "Additional domains: " . implode(', ', $details['additional_domains']);
        }
    }
}
```

#### Getting a single detected certificate

```php
// returns OhDear\PhpSdk\Dto\DetectedCertificate
$certificate = $ohDear->detectedCertificate($monitorId, $certificateId);

echo "Certificate fingerprint: {$certificate->fingerprint}";
echo "Created at: {$certificate->createdAt}";
```

### DNS History Items

DNS history items track changes to your domain's DNS records over time, helping you monitor DNS propagation and detect unauthorized changes.

#### Getting all DNS history items for a monitor

```php
// returns an array of OhDear\PhpSdk\Dto\DnsHistoryItem
$dnsHistoryItems = $ohDear->dnsHistoryItems($monitorId);

foreach ($dnsHistoryItems as $historyItem) {
    echo "DNS History Item ID: {$historyItem->id}";
    echo "Created at: {$historyItem->createdAt}";
    echo "Diff summary: {$historyItem->diffSummary}";
    
    print_r($historyItem->authoritativeNameservers);
    print_r($historyItem->dnsRecords);
}
```

#### Getting a single DNS history item

```php
// returns OhDear\PhpSdk\Dto\DnsHistoryItem
$historyItem = $ohDear->dnsHistoryItem($monitorId, $historyItemId);
```

### Lighthouse Reports

Lighthouse reports provide detailed performance, accessibility, SEO, and best practices analysis of your web pages using Google's Lighthouse auditing tool.

#### Getting all lighthouse reports for a monitor

```php
// returns an array of OhDear\PhpSdk\Dto\LighthouseReport
$lighthouseReports = $ohDear->lighthouseReports($monitorId);

foreach ($lighthouseReports as $report) {
    echo "Report ID: {$report->id}";
    echo "Created at: {$report->createdAt}";
    echo "Performance Score: {$report->performanceScore}/100";
    echo "Accessibility Score: {$report->accessibilityScore}/100";
    echo "Best Practices Score: {$report->bestPracticesScore}/100";
    echo "SEO Score: {$report->seoScore}/100";
    echo "PWA Score: {$report->progressiveWebAppScore}/100";
    
    // Core Web Vitals
    echo "First Contentful Paint: {$report->firstContentfulPaintInMs}ms";
    echo "Speed Index: {$report->speedIndexInMs}ms";
    echo "Largest Contentful Paint: {$report->largestContentfulPaintInMs}ms";
    echo "Time to Interactive: {$report->timeToInteractiveInMs}ms";
    echo "Total Blocking Time: {$report->totalBlockingTimeInMs}ms";
    echo "Cumulative Layout Shift: {$report->cumulativeLayoutShift}";
    
    // Server location
    echo "Performed on server: {$report->performedOnCheckerServer}";
    
    // Issues detected
    if ($report->issues && !empty($report->issues)) {
        echo "Issues detected: " . json_encode($report->issues);
    }
}
```

#### Getting a single lighthouse report

```php
// returns OhDear\PhpSdk\Dto\LighthouseReport (includes full json_report)
$report = $ohDear->lighthouseReport($monitorId, $reportId);

echo "Performance Score: {$report->performanceScore}/100";
echo "Accessibility Score: {$report->accessibilityScore}/100";

// Full Lighthouse JSON report (only available when fetching single report)
if ($report->jsonReport) {
    $fullReport = $report->jsonReport;
    // Access detailed lighthouse audit data
}
```

#### Getting the latest lighthouse report

```php
// returns OhDear\PhpSdk\Dto\LighthouseReport
$latestReport = $ohDear->latestLighthouseReport($monitorId);

echo "Latest performance score: {$latestReport->performanceScore}/100";
echo "Report generated: {$latestReport->createdAt}";
```

### Application Health Checks

Application health checks monitor custom endpoints in your application to ensure they're responding correctly and returning expected health status information.

#### Getting all application health checks for a monitor

```php
// returns an array of OhDear\PhpSdk\Dto\ApplicationHealthCheck
$healthChecks = $ohDear->applicationHealthChecks($monitorId);

foreach ($healthChecks as $healthCheck) {
    echo "Health Check: {$healthCheck->name} ({$healthCheck->label})";
    echo "Status: {$healthCheck->status}";
    echo "Message: {$healthCheck->message}";
    echo "Short summary: {$healthCheck->shortSummary}";
    
    if ($healthCheck->detectedAt) {
        echo "Detected at: {$healthCheck->detectedAt}";
    }
    
    if ($healthCheck->updatedAt) {
        echo "Last updated: {$healthCheck->updatedAt}";
    }
    
    // Check if snoozed
    if ($healthCheck->activeSnooze) {
        echo "Currently snoozed until: {$healthCheck->activeSnooze['ends_at']}";
    }
    
    // Additional metadata
    if (!empty($healthCheck->meta)) {
        echo "Metadata: " . json_encode($healthCheck->meta);
    }
}
```

#### Getting history for a specific application health check

```php
// returns an array of OhDear\PhpSdk\Dto\ApplicationHealthCheckHistoryItem
$history = $ohDear->applicationHealthCheckHistory($monitorId, $healthCheckId);

foreach ($history as $historyItem) {
    echo "History Item ID: {$historyItem->id}";
    echo "Status: {$historyItem->status}";
    echo "Short summary: {$historyItem->shortSummary}";
    echo "Message: {$historyItem->message}";
    echo "Detected at: {$historyItem->detectedAt}";
    echo "Updated at: {$historyItem->updatedAt}";
}
```

### Sitemap

The sitemap check analyzes your website's XML sitemap(s) to ensure they're accessible and properly formatted, and can also check the reachability of URLs within the sitemaps.

#### Getting sitemap analysis for a monitor

```php
// returns OhDear\PhpSdk\Dto\Sitemap
$sitemap = $ohDear->sitemap($monitorId);

echo "Sitemap check URL: {$sitemap->checkUrl}";
echo "Total URLs found: {$sitemap->totalUrlCount}";
echo "Total issues found: {$sitemap->totalIssuesCount}";
echo "Has issues: " . ($sitemap->hasIssues ? 'Yes' : 'No');

// Check for general issues
if (!empty($sitemap->issues)) {
    echo "General issues:";
    foreach ($sitemap->issues as $issue) {
        echo "- {$issue['message']} (Type: {$issue['type']})";
    }
}

// Sitemap indexes (if any)
if (!empty($sitemap->sitemapIndexes)) {
    echo "Sitemap indexes found: " . count($sitemap->sitemapIndexes);
    foreach ($sitemap->sitemapIndexes as $index) {
        echo "Index: {$index['url']}";
        if (!empty($index['issues'])) {
            echo "  Issues: " . count($index['issues']);
        }
    }
}

// Individual sitemaps
if (!empty($sitemap->sitemaps)) {
    echo "Sitemaps found: " . count($sitemap->sitemaps);
    foreach ($sitemap->sitemaps as $sitemapData) {
        echo "Sitemap: {$sitemapData['url']}";
        echo "  URLs: {$sitemapData['urlCount']}";
        
        if (!empty($sitemapData['issues'])) {
            echo "  Issues: " . count($sitemapData['issues']);
            foreach ($sitemapData['issues'] as $issue) {
                echo "    - {$issue['message']}";
            }
        }
    }
}
```

### Mixed Content

The mixed content check identifies elements on your HTTPS pages that are loaded over HTTP, which can cause security warnings in browsers and degrade user experience.

#### Getting mixed content issues for a monitor

```php
// returns an array of OhDear\PhpSdk\Dto\MixedContent
$mixedContentItems = $ohDear->mixedContent($monitorId);

foreach ($mixedContentItems as $mixedContent) {
    echo "Element: {$mixedContent->elementName}";
    echo "Insecure URL: {$mixedContent->mixedContentUrl}";
    echo "Found on page: {$mixedContent->foundOnUrl}";
    echo "---";
}
```

### Downtime

Downtime periods track when your monitored sites were unavailable, providing historical data about outages and their duration.

#### Getting downtime periods for a monitor

```php
// Get downtime periods with date filters (both parameters required)
// Use Y-m-d H:i:s format - the SDK will convert to the API's expected format
$downtimePeriods = $ohDear->downtime($monitorId, '2024-01-01 00:00:00', '2024-12-31 23:59:59');

    echo "Found " . count($downtimePeriods) . " downtime periods:";
    
foreach ($downtimePeriods as $downtime) {
    echo "Downtime ID: {$downtime->id}";
    echo "Started: {$downtime->startedAt}";
    
    if ($downtime->endedAt) {
        echo "Ended: {$downtime->endedAt}";
        
        // Calculate duration
        $start = new DateTime($downtime->startedAt);
        $end = new DateTime($downtime->endedAt);
        $duration = $end->diff($start);
        echo "Duration: {$duration->format('%h hours, %i minutes')}";
    } else {
        echo "Status: Still ongoing";
    }
    
    // Display notes if available
    if ($downtime->notesHtml) {
        echo "Notes (HTML): {$downtime->notesHtml}";
    }
    
    if ($downtime->notesMarkdown) {
        echo "Notes (Markdown): {$downtime->notesMarkdown}";
    }
}
```

#### Deleting a downtime period

You can delete downtime periods that were recorded incorrectly or are no longer needed:

```php
$ohDear->deleteDowntimePeriod($downtimePeriodId);
```

### Using Saloon requests directly

This SDK uses [Saloon](https://docs.saloon.dev) to make the HTTP requests. Instead of using the `OhDear` class, you can the underlying request classes directly. This way, you have full power to customize the requests.

```php
use OhDear\PhpSdk\Requests\Monitors\GetMonitorsRequest;

$request = new GetMonitorsRequest();

// raw response from the Oh Dear API
$response = $ohDear->send($request);
```

Take a look at the [Saloon documentation](https://docs.saloon.dev) to learn more about how to customize the requests.

## Security

If you discover any security related issues, please email support@ohdear.app instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
