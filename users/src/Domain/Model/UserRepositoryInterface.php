<?php

declare(strict_types=1);

namespace App\Domain\Model;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findOneByEmail(string $email): ?User;
}
