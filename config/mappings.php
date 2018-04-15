<?php
declare(strict_types=1);

return [
    'EmailValidator\Domain\Entity\EmailValidation' => [
        'type'   => 'entity',
        'table'  => 'email_validations',
        'id'     => [
            'id' => [
                'type' => 'EmailValidationId'
            ],
        ],
        'fields' => [
            'email' => [
                'type' => 'string'
            ],
            'isValidEmail' => [
                'type' => 'boolean'
            ],
            'validatedTimestamp' => [
                'type' => 'datetime_immutable',
            ]
        ]
    ]
];
