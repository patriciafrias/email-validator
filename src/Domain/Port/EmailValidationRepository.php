<?php
declare(strict_types=1);

namespace EmailValidator\Domain\Port;

use EmailValidator\Domain\Entity\EmailValidation;

interface EmailValidationRepository
{
    /**
     * @return EmailValidation[]
     */
    public function findAll(): array;

    /**
     * @return EmailValidation|null
     */
    public function find(string $email):? EmailValidation;

    /**
     * @return EmailValidation|null
     */
    public function findOneByEmailByDate(string $email):? EmailValidation;

    public function add(EmailValidation $emailValidation): void;
}
