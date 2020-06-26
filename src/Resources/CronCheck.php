<?php

namespace OhDear\PhpSdk\Resources;

class CronCheck extends ApiResource
{
    public int $id;

    public string $uuid;

    public int $checkId;

    public ?int $frequencyInMinutes;

    public int $graceTimeInMinutes;

    public string $cronExpression;
}
