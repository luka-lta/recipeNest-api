<?php

namespace Tests\Value\User;

use PHPUnit\Framework\Attributes\CoversClass;
use RecipeNestApi\Value\User\User;
use PHPUnit\Framework\TestCase;

#[CoversClass(User::class)]
class UserTest extends TestCase
{
    private readonly int $userId;
    private readonly string $username;
    private readonly string $email;
    private readonly string $password;
    private readonly string $avatarUrl;


    protected function setUp(): void
    {
        $this->userId = 1;
        $this->username = 'test';
        $this->email = 'email@exmaple.de';
        $this->password = 'password';
        $this->avatarUrl = 'https://example.com/avatar.jpg';
    }

    public function testCanCreateAndGetUser(): void
    {
        $user = User::fromRaw(
            $this->userId,
            $this->username,
            $this->email,
            $this->password,
            $this->avatarUrl
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($this->userId, $user->getUserId());
        $this->assertSame($this->username, (string)$user->getUsername());
        $this->assertSame($this->email, (string)$user->getEmail());
        $this->assertIsString((string)$user->getPassword());
        $this->assertSame($this->avatarUrl, (string)$user->getProfilePicture());
    }

    public function testCanCreateFromDatabase(): void
    {
        $user = User::fromDatabase([
            'user_id' => $this->userId,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'profile_picture' => $this->avatarUrl,
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($this->userId, $user->getUserId());
        $this->assertSame($this->username, (string)$user->getUsername());
        $this->assertSame($this->email, (string)$user->getEmail());
        $this->assertIsString((string)$user->getPassword());
        $this->assertSame($this->avatarUrl, (string)$user->getProfilePicture());
    }

    public function testCanCreateFromDatabaseWithAvatarNull(): void
    {
        $user = User::fromDatabase([
            'user_id' => $this->userId,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'profile_picture' => null,
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($this->userId, $user->getUserId());
        $this->assertSame($this->username, (string)$user->getUsername());
        $this->assertSame($this->email, (string)$user->getEmail());
        $this->assertIsString((string)$user->getPassword());
        $this->assertNull((string)$user->getProfilePicture());
    }
}
