<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\User\Create\UserCreateCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class UserCreateAction
{
    use HandleTrait;

    public function __construct(
        private readonly MessageBusInterface $commandBus
    )
    {
        $this->messageBus = $commandBus;
    }

    #[Route(path: '/users', name: 'create_user', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $payload = $request->getPayload();

        $command = new UserCreateCommand(
            $payload->get('email'),
            $payload->get('firstName'),
            $payload->get('lastName')
        );
        $this->handle($command);

        return new JsonResponse(['message' => $request->getPayload()->get('email')], Response::HTTP_CREATED);
    }

}