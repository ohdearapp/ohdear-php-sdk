<?php

namespace OhDear\PhpSdk\Requests\LighthouseReports;

use OhDear\PhpSdk\Dto\LighthouseReport;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetLighthouseReportRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $monitorId,
        protected int $lighthouseReportId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/monitors/{$this->monitorId}/lighthouse-reports/{$this->lighthouseReportId}";
    }

    public function createDtoFromResponse(Response $response): LighthouseReport
    {
        return LighthouseReport::fromResponse($response->json());
    }
}