<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use EmailValidator\Domain\EmailValidationManager;

class WebEmailValidationController
{
    /**
     * @var EmailValidationManager
     */
    private $emailValidationManager;

    public function __construct(EmailValidationManager $emailValidationManager)
    {
        $this->emailValidationManager = $emailValidationManager;
    }

    public function index()
    {
        $data = [
            'emailValidationsReport' => $this->emailValidationManager->getEmailValidations(),
        ];

        return view('email-validation.index', compact('data'));
    }
}
