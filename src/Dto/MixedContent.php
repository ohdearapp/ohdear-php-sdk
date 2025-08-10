<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class MixedContent
{
    public function __construct(
        public string $elementName,
        public string $mixedContentUrl,
        public string $foundOnUrl,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            elementName: $data['element_name'],
            mixedContentUrl: $data['mixed_content_url'],
            foundOnUrl: $data['found_on_url'],
        );
    }

    public static function collect(Response $response): array
    {
        return array_map(
            fn (array $item) => self::fromResponse($item),
            $response->json('data')
        );
    }
}
