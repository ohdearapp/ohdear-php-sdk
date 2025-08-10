<?php

namespace OhDear\PhpSdk\Requests\MaintenancePeriods;

use OhDear\PhpSdk\Dto\MaintenancePeriod;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetMaintenancePeriodsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected ?string $startedAt = null,
        protected ?string $endedAt = null
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/maintenance-periods";
    }

    protected function defaultQuery(): array
    {
        $query = [];

        if ($this->startedAt !== null) {
            $query['filter']['started_at'] = $this->startedAt;
        }

        if ($this->endedAt !== null) {
            $query['filter']['ended_at'] = $this->endedAt;
        }

        return $query;
    }

    /** @return array<int, MaintenancePeriod> */
    public function createDtoFromResponse(Response $response): array
    {
        return MaintenancePeriod::collect($response->json('data'));
    }
}
