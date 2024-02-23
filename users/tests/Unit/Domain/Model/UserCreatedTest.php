<?php

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\UserCreated;
use PHPUnit\Framework\TestCase;

class UserCreatedTest extends TestCase
{
    public function testCanCreateUserInstance(): void
    {
        $data = [
            'email' => 'haji@example.com',
            'firstName' => 'Haji',
            'lastName' => 'Fernandez',
        ];

        $user = new UserCreated(
            $data['email'],
            $data['firstName'],
            $data['lastName']
        );

        self::assertSame($data['email'], $user->getEmail());
        self::assertSame($data['firstName'], $user->getFirstName());
        self::assertSame($data['lastName'], $user->getLastName());
    }
}