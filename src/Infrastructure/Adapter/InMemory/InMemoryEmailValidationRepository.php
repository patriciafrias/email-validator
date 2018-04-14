<?php
declare(strict_types=1);

namespace EmailValidator\Infrastructure\Adapter\InMemory;

use DateTimeImmutable;
use EmailValidator\Domain\Entity\EmailValidation;
use EmailValidator\Domain\Port\EmailValidationRepository;

class InMemoryEmailValidationRepository implements EmailValidationRepository
{
    /** @var EmailValidation[] */
    private $emailValidations;

    public function __construct(array $emailValidations)
    {
        $this->emailValidations = $emailValidations;
    }

    public function findAll(): array
    {
        return array_map(function ($item) {
            return clone $item;
        }, $this->emailValidations);
    }

    public function find(string $email):? EmailValidation
    {
        // TODO: Implement find() method.
    }

    public function findOneByEmailByDate(string $email):? EmailValidation
    {
        $date = new DateTimeImmutable();

        $today = $date->format('Y-m-d');

        $emailValidation = null;

        foreach ($this->emailValidations as $item) {
            if ($item->getEmail() === $email &&
                $item->getValidationDate()->format('Y-m-d') === $today) {
                $emailValidation = $item;
            }
        }

        return $emailValidation;
    }

    public function add(EmailValidation $emailValidation): void
    {
        $this->emailValidations[] = $emailValidation;
    }
}
