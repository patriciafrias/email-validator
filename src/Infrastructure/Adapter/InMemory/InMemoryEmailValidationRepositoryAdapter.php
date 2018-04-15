<?php
declare(strict_types=1);

namespace EmailValidator\Infrastructure\Adapter\InMemory;

use function array_key_exists;
use DateTimeImmutable;
use EmailValidator\Domain\Entity\EmailValidation;
use EmailValidator\Domain\Port\EmailValidationRepositoryInterface;

class InMemoryEmailValidationRepositoryAdapter implements EmailValidationRepositoryInterface
{
    /** @var EmailValidation[] */
    private $emailValidations = [];

    public function __construct(array $emailValidations)
    {
        foreach ($emailValidations as $emailValidation) {
            $this->addEmailValidationByKey($emailValidation);
        }
    }

    public function findAll(): array
    {
        return array_map(function ($item) {
            return clone $item;
        }, $this->emailValidations);
    }

    public function findOneByEmailAndDate(string $email):? EmailValidation
    {
        $date = new DateTimeImmutable();

        $key = $email . ':'. $date->format('Y-m-d');

        if (array_key_exists($key, $this->emailValidations)) {
            return $this->emailValidations[$key];
        }

        return null;
    }

    public function getReport(): array
    {
        $result = [];
        foreach ($this->emailValidations as $emailValidation) {
            $key = $emailValidation->getValidatedTimestamp()->format('Y-m-d');

            if (!array_key_exists($key, $result)) {
                $result[$key] = [
                    'short_date' => $key,
                    'valid_emails' => 0,
                    'invalid_emails' => 0,
                ];
            }

            if ($emailValidation->isValidEmail()) {
                $result[$key]['valid_emails'] += 1;
            } else {
                $result[$key]['invalid_emails'] += 1;
            }
        }

        return $result;
    }

    public function add(EmailValidation $emailValidation): void
    {
        $this->addEmailValidationByKey($emailValidation);
    }

    private function addEmailValidationByKey(EmailValidation $emailValidation): void
    {
        $key = $emailValidation->getEmail() . ':' . $emailValidation->getValidatedTimestamp()->format('Y-m-d');
        $this->emailValidations[$key] = $emailValidation;
    }
}
