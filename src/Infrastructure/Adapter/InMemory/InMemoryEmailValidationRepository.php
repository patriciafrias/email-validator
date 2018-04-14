<?php
declare(strict_types=1);

namespace EmailValidator\Infrastructure\Adapter\InMemory;

use EmailValidator\Domain\EmailValidation;
use EmailValidator\Domain\Port\EmailValidationRepository;

class InMemoryEmailValidationRepository implements EmailValidationRepository
{
    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function find($email): EmailValidation
    {
        // TODO: Implement find() method.
    }

    public function add(EmailValidation $emailValidation): void
    {
        // TODO: Implement add() method.
    }

    public function update(EmailValidation $emailValidation): void
    {
        // TODO: Implement update() method.
    }

    public function remove(EmailValidation $emailValidation): void
    {
        // TODO: Implement remove() method.
    }
}
