<?php

declare(strict_types=1);

namespace RecipeNestApi\Value\User;

class ProfilePicture
{
    private function __construct(
        private readonly string $url
    ) {}

    public static function fromString(string $url): self
    {
        return new self($url);
    }

    public function __toString(): string
    {
        return $this->url;
    }
}
