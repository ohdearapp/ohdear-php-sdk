<?php

namespace OhDear\PhpSdk;

use OhDear\PhpSdk\Concerns\SupportsMeEndpoint;
use OhDear\PhpSdk\Concerns\SupportsMonitorEndpoints;
use OhDear\PhpSdk\Concerns\SupportsStatusPageEndpoints;
use OhDear\PhpSdk\Concerns\SupportsCheckEndpoints;
use OhDear\PhpSdk\Concerns\SupportsMaintenancePeriodEndpoints;
use OhDear\PhpSdk\Concerns\SupportsUptimeMetricsEndpoints;
use OhDear\PhpSdk\Exceptions\OhDearException;
use OhDear\PhpSdk\Exceptions\ValidationException;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\PaginationPlugin\Paginator;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class OhDear extends Connector implements HasPagination
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use SupportsMeEndpoint;
    use SupportsMonitorEndpoints;
    use SupportsStatusPageEndpoints;
    use SupportsCheckEndpoints;
    use SupportsMaintenancePeriodEndpoints;
    use SupportsUptimeMetricsEndpoints;

    protected string $apiToken;

    protected string $baseUrl;

    public function __construct(string $apiToken, string $baseUrl = 'https://ohdear.app/api/')
    {
        $this->apiToken = $apiToken;

        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        if ($response->status() === 422) {
            return new ValidationException($response, $senderException);
        }

        return new OhDearException(
            $response,
            $senderException?->getMessage() ?? 'Request failed',
            $senderException?->getCode() ?? 0,
        );
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->apiToken);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => 10,
        ];
    }

    public function paginate(Request $request): Paginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator
        {
            protected function isLastPage(Response $response): bool
            {
                $currentPage = $response->json('meta.current_page');
                $lastPage = $response->json('meta.last_page');

                return $currentPage === $lastPage;
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dto();
            }
        };
    }
}
