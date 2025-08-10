<?php

namespace OhDear\PhpSdk\Dto;

use Saloon\Http\Response;

class MixedContent
{
    public function __construct(
        public string $element_name,
        public string $mixed_content_url,
        public string $found_on_url,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new static(
            element_name: $data['element_name'],
            mixed_content_url: $data['mixed_content_url'],
            found_on_url: $data['found_on_url'],
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
