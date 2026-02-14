<?php

namespace OhDear\PhpSdk\Dto;

class AiResponse
{
    public function __construct(
        public int $id,
        public int $monitorId,
        public ?string $prompt,
        public ?string $response,
        public ?string $rawResponse,
        public array $tokenUsage,
        public array $toolInvocations,
        public ?string $createdAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            monitorId: $data['monitor_id'],
            prompt: $data['prompt'] ?? null,
            response: $data['response'] ?? null,
            rawResponse: $data['raw_response'] ?? null,
            tokenUsage: $data['token_usage'] ?? [],
            toolInvocations: $data['tool_invocations'] ?? [],
            createdAt: $data['created_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
