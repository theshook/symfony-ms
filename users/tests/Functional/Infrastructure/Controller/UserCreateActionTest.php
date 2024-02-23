<?php

namespace App\Tests\Functional\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserCreateActionTest extends WebTestCase
{
    private KernelBrowser $client;

    public function testCreateUserActionWorks(): void
    {
        $data = [
            'email' => 'test-function@test.com',
            'firstName' => 'functional',
            'lastName' => 'testing'
        ];

        $this->client->jsonRequest(
            method: 'POST',
            uri: '/users',
            parameters: $data
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
    }
}