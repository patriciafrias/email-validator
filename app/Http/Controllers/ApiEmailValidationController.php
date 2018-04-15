<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use EmailValidator\Domain\EmailValidationManager;
use EmailValidator\Domain\Entity\EmailValidation;
use EmailValidator\Domain\Exception\EmailValidationAlreadyExistsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiEmailValidationController
{
    /**
     * @var EmailValidationManager
     */
    private $emailValidationManager;

    public function __construct(EmailValidationManager $emailValidationManager)
    {
        $this->emailValidationManager = $emailValidationManager;
    }

    /**
     * @param Request $request
     * @param string $email
     * @return JsonResponse
     */
    public function validate(Request $request, string $email): JsonResponse
    {
        $emailValidation = new EmailValidation($email);

        try {
            $this->emailValidationManager->addEmailValidation(new EmailValidation($email));
        } catch (EmailValidationAlreadyExistsException $exception) {
            return response()->json([
                'error' => 'Oops... the email was already validated today!'
            ]);
        }

        return response()->json([
            'is_valid' => $emailValidation->isValidEmail()
        ]);
    }
}
