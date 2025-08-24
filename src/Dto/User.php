<?php

namespace OhDear\PhpSdk\Dto;

class User
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $photoUrl,
        public array $teams,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            photoUrl: $data['photo_url'],
            teams: $data['teams'],
        );
    }
}
