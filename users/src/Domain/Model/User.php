<?php

declare(strict_types=1);

namespace App\Domain\Model;

use Symfony\Component\Uid\Uuid;

class User
{
    private Uuid $id;
    public function __construct(
        string $id,
        private readonly string $email,
        private readonly string $firstName,
        private readonly string $lastName
    ) {
        $this->setId($id);
    }

    public function setId(string $id): void
    {
        $this->id = Uuid::fromString($id);
    }

    public function getId(): string
    {
        return (string) $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
