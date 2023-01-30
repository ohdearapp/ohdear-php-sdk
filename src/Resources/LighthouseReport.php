<?php

namespace OhDear\PhpSdk\Resources;

class LighthouseReport extends ApiResource
{
    public int $id;

    public int|null $performanceScore;

    public int|null $accessibilityScore;

    public int|null $bestPracticesScore;

    public int|null $seoScore;

    public int|null $progressiveWebAppScore;

    public float|null $firstContentfulPaintInMs;

    public float|null $speedIndexInMs;

    public float|null $largestContentfulPaintInMs;

    public float|null $timeToInteractiveInMs;

    public float|null $totalBlockingTimeInMs;

    public float|null $cumulativeLayoutShift;

    public string $performedOnCheckerServer;

    public array $issues;

    public string $createdAt;
}
