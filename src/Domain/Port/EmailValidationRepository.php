<?php
declare(strict_types=1);

namespace EmailValidator\Domain\Port;

use EmailValidator\Domain\EmailValidation;

interface EmailValidationRepository
{
    /**
     * @return EmailValidation[]
     */
    public function findAll(): array;

    public function find($email): EmailValidation;

    public function add(EmailValidation $emailValidation): void;

    public function update(EmailValidation $emailValidation): void;

    public function remove(EmailValidation $emailValidation): void;
}
