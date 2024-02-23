<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

final class UserTest extends TestCase
{
    public function testCanCreateUserInstance(): void
    {
        $data = [
            'email' => 'haji@example.com',
            'firstName' => 'Haji',
            'lastName' => 'Fernandez',
        ];

        $user = new User(
            (string) Uuid::v4(),
            email: $data['email'],
            firstName: $data['firstName'],
            lastName: $data['lastName']
        );

        self::assertSame($data['email'], $user->getEmail());
        self::assertSame($data['firstName'], $user->getFirstName());
        self::assertSame($data['lastName'], $user->getLastName());
    }
}
