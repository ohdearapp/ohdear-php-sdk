<?php

namespace OhDear\PhpSdk\Concerns;

use OhDear\PhpSdk\Dto\CronCheckDefinition;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\CreateCronCheckDefinitionRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\DeleteCronCheckDefinitionRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\GetCronCheckDefinitionsRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\SnoozeCronCheckDefinitionRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\UnsnoozeCronCheckDefinitionRequest;
use OhDear\PhpSdk\Requests\CronCheckDefinitions\UpdateCronCheckDefinitionRequest;

/** @mixin \OhDear\PhpSdk\OhDear */
trait SupportsCronCheckDefinitionsEndpoints
{
    /** @return iterable<int, CronCheckDefinition> */
    public function cronCheckDefinitions(int $monitorId): iterable
    {
        $request = new GetCronCheckDefinitionsRequest($monitorId);

        return $this->paginate($request)->items();
    }

    public function createCronCheckDefinition(int $monitorId, array $data): CronCheckDefinition
    {
        $request = new CreateCronCheckDefinitionRequest($monitorId, $data);

        return $this->send($request)->dtoOrFail();
    }

    public function updateCronCheckDefinition(int $cronCheckDefinitionId, array $data): CronCheckDefinition
    {
        $request = new UpdateCronCheckDefinitionRequest($cronCheckDefinitionId, $data);

        return $this->send($request)->dtoOrFail();
    }

    public function deleteCronCheckDefinition($cronCheckDefinitionId): void
    {
        $request = new DeleteCronCheckDefinitionRequest($cronCheckDefinitionId);

        $response = $this->send($request);
        var_dump($response->body());
    }

    public function snoozeCronCheckDefinition(int $cronCheckDefinitionId, int $minutes): CronCheckDefinition
    {
        $request = new SnoozeCronCheckDefinitionRequest($cronCheckDefinitionId, $minutes);

        return $this->send($request)->dtoOrFail();
    }

    public function unsnoozeCronCheckDefinition(int $cronCheckDefinitionId): CronCheckDefinition
    {
        $request = new UnsnoozeCronCheckDefinitionRequest($cronCheckDefinitionId);

        return $this->send($request)->dtoOrFail();
    }
}
