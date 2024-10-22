<?php

declare(strict_types=1);

namespace RecipeNestApi\Value\User;

use JsonSerializable;

class User
{
    private function __construct(
        private readonly ?int           $userId,
        private readonly Username       $username,
        private readonly Email          $email,
        private Password                $password,
        private readonly ProfilePicture $profilePicture,
    ) {
    }

    public static function fromDatabase(array $payload): self
    {
        $profilePicture = $payload['profile_picture'] === null
            ? null
            : ProfilePicture::fromString($payload['profile_picture']);


        return new self(
            $payload['user_id'],
            Username::from($payload['username']),
            Email::from($payload['email']),
            Password::fromHash($payload['password']),
            $profilePicture,
        );
    }

    public static function fromRaw(
        ?int   $userId,
        string $username,
        string $email,
        string $password,
        string $profilePicture = null
    ): self {
        $parsedProfilePicture = $profilePicture === null ? null : ProfilePicture::fromString($profilePicture);

        return new self(
            $userId,
            Username::from($username),
            Email::from($email),
            Password::fromPlain($password),
            $parsedProfilePicture
        );
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getUsername(): Username
    {
        return $this->username;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getProfilePicture(): ?ProfilePicture
    {
        return $this->profilePicture;
    }

    public function setPassword(Password $password): void
    {
        $this->password = $password;
    }

    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'username' => $this->username,
            'email' => $this->email,
            'profilePicture' => $this->profilePicture,
        ];
    }
}
