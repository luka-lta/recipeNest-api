<?php

declare(strict_types=1);

namespace RecipeNestApi\Exception;

class RecipeNestValidationException extends RecipeNestException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}
