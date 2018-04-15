<?php
declare(strict_types=1);

namespace Tests\Unit\EmailValidator\Domain;

use function array_pop;
use EmailValidator\Domain\EmailValidationManager;
use EmailValidator\Domain\Entity\EmailValidation;
use EmailValidator\Infrastructure\Adapter\InMemory\InMemoryEmailValidationRepositoryAdapter;
use Tests\TestCase;

class EmailValidationManagerTest extends TestCase
{
    public const VALID_EMAIL = 'valid@email.com';
    public const INVALID_EMAIL = 'invalid email.com';
    public const DATE_FORMAT = 'Y-m-d';

    /** @var EmailValidationManager */
    private $emailValidationManager;

    public function setUp()
    {
        parent::setUp();

        $this->emailValidationManager = new EmailValidationManager(
            new InMemoryEmailValidationRepositoryAdapter([])
        );
    }

    /**
     * @test
     */
    public function addEmailValidation_whenEmailIsNotStoredYet_shouldStoreNewEmailValidation()
    {
        $newEmail = new EmailValidation(self::VALID_EMAIL);

        $this->emailValidationManager->addEmailValidation($newEmail);

        $this->assertCount(1, $this->emailValidationManager->getEmailValidations());
    }

    /**
     * @test
     *
     * @expectedException \EmailValidator\Domain\Exception\EmailValidationAlreadyExistsException
     */
    public function addEmailValidation_whenEmailIsAlreadyStoredOnSameDay_shouldNotStoreNewEmailValidation()
    {
        $newEmail = new EmailValidation(self::VALID_EMAIL);

        // 1º try
        $this->emailValidationManager->addEmailValidation($newEmail);

        // 2º try
        $this->emailValidationManager->addEmailValidation($newEmail);
    }

    /**
     * @test
     */
    public function getEmailValidations_whenThereAreEmailValidationsStored_shouldReturnAnArrayWithEmailValidations()
    {
        $newEmail1 = new EmailValidation(self::VALID_EMAIL);
        $newEmail2 = new EmailValidation(self::INVALID_EMAIL);

        $this->emailValidationManager->addEmailValidation($newEmail1);
        $this->emailValidationManager->addEmailValidation($newEmail2);

        $report = $this->emailValidationManager->getEmailValidations();
        $this->assertCount(1, $report);

        $firstDay = array_pop($report);
        $this->assertEquals(1, $firstDay['valid_emails']);
        $this->assertEquals(1, $firstDay['invalid_emails']);
    }

    /**
     * @test
     */
    public function getEmailValidations_whenThereAreNotEmailValidationsStored_shouldReturnAnEmptyArray()
    {
        $this->assertEmpty($this->emailValidationManager->getEmailValidations());
    }
}
