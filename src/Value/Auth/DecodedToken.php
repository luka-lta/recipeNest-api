<?php

declare(strict_types=1);

namespace RecipeNestApi\Value\Auth;

use Firebase\JWT\JWT;
use RecipeNestApi\Value\User\User;

class DecodedToken
{
    public function __construct(
        private readonly string $token,
    ) {
    }

    public static function generateToken(User $user): AuthToken
    {
        $payload = [
            'iss' => 'taskwave',
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'sub' => $user->getUserId(),
            'iat' => time(),
            'exp' => time() + 3600,
        ];

        $token = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');

        return new self($token);
    }

    public static function decodeToken(string $token): DecodedToken
    {
        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));

            if ($decoded->exp < time()) {
                throw new TaskWaveInvalidTokenException(
                    'Token expired',
                    StatusCodeInterface::STATUS_UNAUTHORIZED
                );
            }

            if ($decoded->iss !== 'taskwave') {
                throw new TaskWaveInvalidTokenException(
                    'Invalid token issuer',
                    StatusCodeInterface::STATUS_UNAUTHORIZED
                );
            }

            if (!isset($decoded->email) || !isset($decoded->username)) {
                throw new TaskWaveInvalidTokenException(
                    'Required claims missing',
                    StatusCodeInterface::STATUS_UNAUTHORIZED
                );
            }

            if ($decoded->iat > time()) {
                throw new TaskWaveInvalidTokenException(
                    'Invalid token issued at time',
                    StatusCodeInterface::STATUS_UNAUTHORIZED
                );
            }
        } catch (ExpiredException | BeforeValidException | Exception $e) {
            throw new TaskWaveInvalidTokenException(
                'An error occurred on validate token',
                StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
                $e
            );
        }

        return DecodedToken::fromArray((array)$decoded);
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
