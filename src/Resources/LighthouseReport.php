<?php

namespace OhDear\PhpSdk\Resources;

class LighthouseReport extends ApiResource
{
    public int $id;

    public int $performanceScore;

    public int $accessibilityScore;

    public int $bestPracticesScore;

    public int $seoScore;

    public int $progressiveWebAppScore;

    public float $firstContentfulPaintInMs;

    public float $speedIndexInMs;

    public float $largestContentfulPaintInMs;

    public float $timeToInteractiveInMs;

    public float $totalBlockingTimeInMs;

    public float $cumulativeLayoutShift;

    public string $performedOnCheckerServer;

    public array $issues;

    public string $createdAt;
}
