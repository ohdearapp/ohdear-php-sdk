<?php

namespace OhDear\PhpSdk\Requests\Monitors;

use OhDear\PhpSdk\Dto\Monitor;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetMonitorsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?int $teamId = null
    ) {}

    public function resolveEndpoint(): string
    {
        return '/monitors';
    }

    protected function defaultQuery(): array
    {
        $query = [];

        if ($this->teamId !== null) {
            $query['filter']['team_id'] = $this->teamId;
        }

        return $query;
    }

    /** @return array<int, Monitor> */
    public function createDtoFromResponse(Response $response): array
    {
        return Monitor::collect($response->json('data'));
    }
}
