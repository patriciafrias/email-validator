<?php
declare(strict_types=1);

namespace EmailValidator\Infrastructure\Adapter\Doctrine\Domain;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use EmailValidator\Domain\ValueObject\EmailValidationId;

class EmailValidationIdType extends GuidType
{
    public function getName()
    {
        return 'EmailValidationId';
    }

    /**
     * @param EmailValidationId $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->id();
    }

    /**
     * @param EmailValidationId $value
     * @param AbstractPlatform $platform
     * @return EmailValidationId
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return EmailValidationId::create($value);
    }
}
