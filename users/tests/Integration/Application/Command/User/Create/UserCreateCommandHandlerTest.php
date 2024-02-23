<?php

declare(strict_types=1);

namespace App\Tests\Integration\Application\Command\User\Create;

use App\Application\Command\User\Create\UserCreateCommand;
use App\Application\Command\User\Create\UserCreateCommandHandler;
use App\Domain\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class UserCreateCommandHandlerTest extends KernelTestCase
{
	private UserCreateCommandHandler $handler;
	private EntityManagerInterface $em;

	public function setUp(): void
	{
        parent::setUp();
		$this->handler = self::getContainer()->get(UserCreateCommandHandler::class);
		$this->em = self::getContainer()->get('doctrine')->getManager();

        $kernel = self::bootKernel(['environment' => 'test']);
        $application = new Application($kernel);
        $command = $application->find('doctrine:migrations:migrate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['n']);

        $this->em->beginTransaction();
	}

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->em->rollback();
    }

    public function testCanCreateUser(): void
	{
		$repository = $this->em->getRepository(User::class);

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

		$this->handler->__invoke($command);

		$this->assertSame($data['email'], $repository->findOneBy(['email' => $data['email']])->getEmail());
	}
}
