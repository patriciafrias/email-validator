<?php
declare(strict_types=1);

namespace EmailValidator\Domain;

use EmailValidator\Domain\Entity\EmailValidation;
use EmailValidator\Domain\Exception\EmailValidationAlreadyExistsException;
use EmailValidator\Domain\Port\EmailValidationRepositoryInterface;

class EmailValidationManager
{
    /** @var EmailValidationRepositoryInterface */
    private $emailValidationRepository;

    public function __construct(EmailValidationRepositoryInterface $emailValidationRepository)
    {
        $this->emailValidationRepository = $emailValidationRepository;
    }

    /**
     * @throws EmailValidationAlreadyExistsException
     */
    public function addEmailValidation(EmailValidation $emailValidation): void
    {
        $storedEmailValidation = $this->emailValidationRepository->findOneByEmailAndDate($emailValidation->getEmail());

        if (!is_null($storedEmailValidation)) {
            throw new EmailValidationAlreadyExistsException();
        }

        $this->emailValidationRepository->add($emailValidation);
    }

    /**
     * @return EmailValidation[]
     */
    public function getEmailValidations(): array
    {
        return $this->emailValidationRepository->getReport();
    }
}
