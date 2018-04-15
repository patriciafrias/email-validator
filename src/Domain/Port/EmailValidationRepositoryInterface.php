<?php
declare(strict_types=1);

namespace EmailValidator\Domain\Port;

use EmailValidator\Domain\Entity\EmailValidation;

interface EmailValidationRepositoryInterface
{
    /**
     * @return EmailValidation[]
     */
    public function findAll(): array;

    /**
     * @return EmailValidation|null
     */
    public function findOneByEmailAndDate(string $email):? EmailValidation;

    public function getReport(): array;

    public function add(EmailValidation $emailValidation): void;
}
