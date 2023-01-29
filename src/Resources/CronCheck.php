<?php

namespace OhDear\PhpSdk\Resources;

class CronCheck extends ApiResource
{
    public int $id;

    public string $name;

    public string $uuid;

    public string $type;

    public int $checkId;

    public int|null $frequencyInMinutes;

    public string $pingUrl;

    public int $graceTimeInMinutes = 0;

    public string|null $cronExpression = '';

    public string|null $description = '';

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }

    public function delete(): void
    {
        $this->ohDear->deleteCronCheck($this->id);
    }

    public function update()
    {
        $attributes = [
            'name' => $this->name,
            'frequency_in_minutes' => $this->frequencyInMinutes,
            'cron_expression' => $this->cronExpression,
            'grace_time_in_minutes' => $this->graceTimeInMinutes,
            'description' => $this->description,
        ];

        $this->ohDear->updateCronCheck($this->id, $attributes);
    }
}
