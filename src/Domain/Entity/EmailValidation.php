<?php
declare(strict_types=1);

namespace EmailValidator\Domain\Entity;

use DateTimeImmutable;
use EmailValidator\Domain\ValueObject\EmailValidationId;

class EmailValidation
{
    /** @var EmailValidationId */
    private $id;

    /** @var string */
    private $email;

    /** @var bool */
    private $isValidEmail;

    /** @var DateTimeImmutable */
    private $validationDate;

    public function __construct(string $email)
    {
        $this->id = EmailValidationId::create();
        $this->email = $email;
        $this->validateEmail($email);
        $this->validationDate = new DateTimeImmutable();
    }

    public function getId(): EmailValidationId
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isValidEmail(): bool
    {
        return $this->isValidEmail;
    }

    public function getValidationDate(): DateTimeImmutable
    {
        return $this->validationDate;
    }

    private function validateEmail(string $email)
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->isValidEmail = false;
        } else {
            $this->isValidEmail = true;
        }
    }
}
