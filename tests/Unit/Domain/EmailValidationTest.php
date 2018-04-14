<?php
declare(strict_types=1);

namespace Tests\Unit\EmailValidator\Domain;

use EmailValidator\Domain\Entity\EmailValidation;
use Tests\TestCase;

class EmailValidationTest extends TestCase
{
    public const VALID_EMAIL = 'valid@email.com';

    public const INVALID_EMAIL = 'invalid email.com';

    public const DATE_FORMAT = 'Y-m-d';

    /**
     * @test
     */
    public function emailValidation_withValidEmail_shouldReturnIsValidEmailTrue()
    {
        $emailValidation = new EmailValidation(self::VALID_EMAIL);

        $this->assertTrue($emailValidation->isValidEmail());
    }

    /**
     * @test
     */
    public function emailValidation_withInvalidEmail_shouldReturnIsValidEmailFalse()
    {
        $emailValidation = new EmailValidation(self::INVALID_EMAIL);

        $this->assertFalse($emailValidation->isValidEmail());
    }
}
