<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Model\User;
use App\Domain\Model\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final readonly class DoctrineUserRepository implements UserRepositoryInterface
{
    private ObjectRepository $repository;

    public function __construct(private EntityManagerInterface $em)
    {
        $this->repository = $this->em->getRepository(User::class);
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }

    public function save(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }
}
