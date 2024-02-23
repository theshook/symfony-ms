<?php

declare(strict_types=1);

namespace App\Application\Command\User\Create;

use App\Domain\Model\User;
use App\Domain\Model\UserCreated;
use App\Domain\Model\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class UserCreateCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private MessageBusInterface     $messageBus
    )
    {
    }

    public function __invoke(UserCreateCommand $command): void
    {
        $user = new User(
            (string) Uuid::v4(),
            $command->getEmail(),
            $command->getFirstName(),
            $command->getLastName()
        );
        $this->repository->save($user);
        $this->messageBus->dispatch(
            new UserCreated(
                $command->getEmail(),
                $command->getFirstName(),
                $command->getLastName()
            )
        );
    }
}
