<?php
declare(strict_types=1);

namespace EmailValidator\Infrastructure\Adapter\InMemory;

use function array_key_exists;
use DateTimeImmutable;
use EmailValidator\Domain\Entity\EmailValidation;
use EmailValidator\Domain\Port\EmailValidationRepositoryInterface;

class InMemoryEmailValidationRepository implements EmailValidationRepositoryInterface
{
    /** @var EmailValidation[] */
    private $emailValidations;

    public function __construct(array $emailValidations)
    {
        foreach ($emailValidations as $emailValidation) {
            $key = $emailValidation->getEmail() . ':'. $emailValidation->getValidationDate()->format('Y-m-d');
            $this->emailValidations[$key] = $emailValidation;
        }

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

        $key = $email . ':'. $date->format('Y-m-d');

        if (array_key_exists($key, $this->emailValidations)) {
            return $this->emailValidations[$key];
        }

        return null;
    }

    public function add(EmailValidation $emailValidation): void
    {
        $this->emailValidations[] = $emailValidation;
    }
}
