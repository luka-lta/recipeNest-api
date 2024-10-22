<?php

declare(strict_types=1);

namespace RecipeNestApi\Value\User;

use RecipeNestApi\Exception\RecipeNestValidationException;

class Email
{
    private function __construct(
        private readonly string $email
    ) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RecipeNestValidationException(
                'Invalid email address',
            );
        }
    }

    public static function from(string $email): self
    {
        return new self($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
