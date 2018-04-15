<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class WebEmailValidationControllerTest extends TestCase
{
    private const BASE_URL = 'http://email-validator.local';

    public function testBasicTest()
    {
        $response = $this->get(self::BASE_URL . '/');

        $response->assertStatus(200);
    }
}
