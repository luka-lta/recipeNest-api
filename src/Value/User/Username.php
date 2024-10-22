<?php

declare(strict_types=1);

namespace RecipeNestApi\Value\User;

use RecipeNestApi\Exception\RecipeNestValidationException;

class Username
{
    private function __construct(
        private readonly string $username,
    ) {
        if (empty($username)) {
            throw new RecipeNestValidationException(
                'Username cannot be empty',
            );
        }

        if (strlen($username) < 3) {
            throw new RecipeNestValidationException(
                'Username must be at least 3 characters long',
            );
        }

        if (strlen($username) > 32) {
            throw new RecipeNestValidationException(
                'Username must be at most 20 characters long',
            );
        }

        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
            throw new RecipeNestValidationException(
                'Username must contain only letters, numbers, lines and underscores',
            );
        }
    }

    public static function from(string $username): self
    {
        return new self($username);
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
