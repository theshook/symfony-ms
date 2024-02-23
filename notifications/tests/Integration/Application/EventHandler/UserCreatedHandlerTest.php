<?php

namespace App\Tests\Integration\Application\EventHandler;

use App\Application\EventHandler\UserCreatedHandler;
use App\Domain\Model\UserCreated;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserCreatedHandlerTest extends KernelTestCase
{
    private UserCreatedHandler $handler;

    public function testCanLogReceivePayload(): void
    {
        $this->expectNotToPerformAssertions();
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

        $this->handler->__invoke($user);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = self::getContainer()->get(UserCreatedHandler::class);
    }
}