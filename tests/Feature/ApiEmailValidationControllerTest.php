<?php
declare(strict_types=1);

namespace Tests\Feature;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Tests\Feature\Fixtures\EmailValidationFixtures;
use Tests\TestCase;

class ApiEmailValidationControllerTest extends TestCase
{
    private const BASE_URL = 'http://email-validator.local';

    private const VALID_EMAIL_1   = 'valid@email-1.com';
    private const INVALID_EMAIL_1 = 'invalidemail-1.com';
    private const VALID_EMAIL_2   = 'valid@email-2.com';

    public function setUp()
    {
        parent::setUp();

        $this->loadFixtures();
    }

    /**
     * @test
     */
    public function emailValidation_withValidEmail_shouldReturnIsValidEmailTrue()
    {
        $response = $this->get(self::BASE_URL . '/api/validate/email/' . self::VALID_EMAIL_1);

        $response->assertStatus(200);
        $response->assertJson([
            'is_valid' => true
        ]);
    }

    /**
     * @test
     */
    public function emailValidation_withInvalidEmail_shouldReturnIsValidEmailFalse()
    {
        $response = $this->get(self::BASE_URL . '/api/validate/email/' . self::INVALID_EMAIL_1);

        $response->assertStatus(200);
        $response->assertJson([
            'is_valid' => false
        ]);
    }
    /**
     * @test
     */
    public function addEmailValidation_whenEmailIsAlreadyStoredOnSameDay_shouldNotStoreNewEmailValidation()
    {
        // 1º try
        $response1 = $this->get(self::BASE_URL . '/api/validate/email/' . self::VALID_EMAIL_2);

        // 2º try
        $response2 = $this->get(self::BASE_URL . '/api/validate/email/' . self::VALID_EMAIL_2);

        $response1->assertStatus(200);
        $response1->assertJson([
            'is_valid' => true
        ]);

        $response2->assertStatus(200);
        $response2->assertJson([
            'error' => 'Oops... the email was already validated today!'
        ]);
    }

    private function loadFixtures(): void
    {
        $loader = new Loader();
        $loader->addFixture(new EmailValidationFixtures());

        $purger = new ORMPurger();
        $executor = new ORMExecutor(app('em'), $purger);
        $executor->execute($loader->getFixtures());
    }
}
