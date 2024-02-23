<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Command\User\Create;

use App\Application\Command\User\Create\UserCreateCommand;
use PHPUnit\Framework\TestCase;

final class UserCreateCommandTest extends TestCase
{
    public function testCanInitializeUserCreateCommand(): void
    {
        $data = [
            'email' => 'haji@example.com',
            'firstName' => 'Haji',
            'lastName' => 'Fernandez',
        ];

        $command = new UserCreateCommand(
            $data['email'],
            $data['firstName'],
            $data['lastName']
        );

        self::assertSame($data['email'], $command->getEmail());
        self::assertSame($data['firstName'], $command->getFirstName());
        self::assertSame($data['lastName'], $command->getLastName());
    }
}
