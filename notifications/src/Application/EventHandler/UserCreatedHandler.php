<?php

namespace App\Application\EventHandler;

use App\Domain\Model\UserCreated;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UserCreatedHandler
{
    public function __construct(
        private LoggerInterface $logger
    )
    {
    }

    public function __invoke(UserCreated $user): void
    {
        $this->logger->info("Message from Users Service");
        $this->logger->info("User Created: ", (array) $user);
    }
}