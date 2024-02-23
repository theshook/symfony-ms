<?php

namespace App\Tests\Integration\Repository;

use App\Domain\Model\User;
use App\Infrastructure\Repository\DoctrineUserRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Uid\Uuid;

class DoctrineUserRepositoryTest extends KernelTestCase
{
    private DoctrineUserRepository $repository;
    private Connection $connection;

    public function testCanPersistUser(): void
    {
        $payload = [
            'id' => (string) Uuid::v4(),
            'email' => "test@email.com",
            'firstName' => "testFirstName",
            'lastName' => "testLastName"
        ];

        $user = new User(
            $payload['id'],
            $payload['email'],
            $payload['firstName'],
            $payload['lastName']
        );
        $this->repository->save($user);
        $this->assertSame($user, $this->repository->findOneByEmail($user->getEmail()));
    }

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        /** @var Connection $connection */
        $connection = self::getContainer()->get('doctrine.dbal.default_connection');
        $this->connection = $connection;

        /** @var DoctrineUserRepository $repository */
        $repository = self::getContainer()->get(DoctrineUserRepository::class);
        $this->repository = $repository;

        $kernel = self::bootKernel(['environment' => 'test']);
        $application = new Application($kernel);
        $command = $application->find('doctrine:migrations:migrate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['n']);

        $this->connection->beginTransaction();
    }

    /**
     * @throws Exception
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->connection->rollback();
    }
}