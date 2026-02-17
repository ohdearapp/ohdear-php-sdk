<?php

namespace OhDear\PhpSdk\Dto;

class AiResponse
{
    public function __construct(
        public int $id,
        public ?string $result,
        public ?string $finishReason,
        public ?string $prompt,
        public ?string $text,
        public ?string $notificationTitle,
        public ?string $notificationBody,
        public array $usedTools,
        public ?int $usedPromptTokens,
        public ?int $usedCompletionTokens,
        public ?string $rawResponse,
        public ?string $startedAt,
        public ?string $endedAt,
        public ?string $createdAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            result: $data['result'] ?? null,
            finishReason: $data['finish_reason'] ?? null,
            prompt: $data['prompt'] ?? null,
            text: $data['text'] ?? null,
            notificationTitle: $data['notification_title'] ?? null,
            notificationBody: $data['notification_body'] ?? null,
            usedTools: $data['used_tools'] ?? [],
            usedPromptTokens: $data['used_prompt_tokens'] ?? null,
            usedCompletionTokens: $data['used_completion_tokens'] ?? null,
            rawResponse: $data['raw_response'] ?? null,
            startedAt: $data['started_at'] ?? null,
            endedAt: $data['ended_at'] ?? null,
            createdAt: $data['created_at'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
