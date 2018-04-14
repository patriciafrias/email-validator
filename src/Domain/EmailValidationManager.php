<?php
declare(strict_types=1);

namespace EmailValidator\Domain;

use EmailValidator\Domain\Entity\EmailValidation;
use EmailValidator\Domain\Exception\EmailValidationAlreadyExistsException;
use EmailValidator\Domain\Port\EmailValidationRepository;
use function is_null;

class EmailValidationManager
{
    /** @var EmailValidationRepository */
    private $validationRepository;

    public function __construct(EmailValidationRepository $validationRepository)
    {
        $this->validationRepository = $validationRepository;
    }

    /**
     * @throws EmailValidationAlreadyExistsException
     */
    public function addEmailValidation(EmailValidation $emailValidation): void
    {
        $storedEmailValidation = $this->getEmailValidationByEmailByDate($emailValidation->getEmail());

        if (!is_null($storedEmailValidation)) {
            throw new EmailValidationAlreadyExistsException();
        }

        $this->validationRepository->add($emailValidation);
    }

    /**
     * @return EmailValidation[]
     */
    public function getEmailValidations(): array
    {
        return $this->validationRepository->findAll();
    }

    /**
     * @return EmailValidation|null
     */
    private function getEmailValidationByEmailByDate(string $email):? EmailValidation
    {
        $emailValidation = $this->validationRepository->findOneByEmailByDate($email);

        return $emailValidation;
    }
}
