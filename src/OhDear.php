<?php

namespace OhDear\PhpSdk;

use OhDear\PhpSdk\Concerns\SupportsApplicationHealthChecksEndpoints;
use OhDear\PhpSdk\Concerns\SupportsBrokenLinksEndpoints;
use OhDear\PhpSdk\Concerns\SupportsCertificateHealthEndpoints;
use OhDear\PhpSdk\Concerns\SupportsCheckEndpoints;
use OhDear\PhpSdk\Concerns\SupportsCronCheckDefinitionsEndpoints;
use OhDear\PhpSdk\Concerns\SupportsDetectedCertificatesEndpoints;
use OhDear\PhpSdk\Concerns\SupportsDnsHistoryItemsEndpoints;
use OhDear\PhpSdk\Concerns\SupportsDowntimeEndpoints;
use OhDear\PhpSdk\Concerns\SupportsLighthouseReportsEndpoints;
use OhDear\PhpSdk\Concerns\SupportsMaintenancePeriodEndpoints;
use OhDear\PhpSdk\Concerns\SupportsMeEndpoint;
use OhDear\PhpSdk\Concerns\SupportsMixedContentEndpoints;
use OhDear\PhpSdk\Concerns\SupportsMonitorEndpoints;
use OhDear\PhpSdk\Concerns\SupportsSitemapEndpoints;
use OhDear\PhpSdk\Concerns\SupportsStatusPageEndpoints;
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
    use SupportsApplicationHealthChecksEndpoints;
    use SupportsBrokenLinksEndpoints;
    use SupportsCertificateHealthEndpoints;
    use SupportsCheckEndpoints;
    use SupportsCronCheckDefinitionsEndpoints;
    use SupportsDetectedCertificatesEndpoints;
    use SupportsDnsHistoryItemsEndpoints;
    use SupportsDowntimeEndpoints;
    use SupportsLighthouseReportsEndpoints;
    use SupportsMaintenancePeriodEndpoints;
    use SupportsMeEndpoint;
    use SupportsMixedContentEndpoints;
    use SupportsMonitorEndpoints;
    use SupportsSitemapEndpoints;
    use SupportsStatusPageEndpoints;
    use SupportsUptimeMetricsEndpoints;

    protected string $apiToken;

    protected string $baseUrl;

    protected int $timeoutInSeconds;

    public function __construct(
        string $apiToken,
        string $baseUrl = 'https://ohdear.app/api/',
        int $timeoutInSeconds = 10,
    ) {
        $this->apiToken = $apiToken;
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->timeoutInSeconds = $timeoutInSeconds;
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        if ($response->status() === 422) {
            return new ValidationException($response);
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
            'timeout' => $this->timeoutInSeconds,
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
                return $request->createDtoFromResponse($response);
            }
        };
    }
}
