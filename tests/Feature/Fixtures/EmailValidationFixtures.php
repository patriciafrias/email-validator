<?php
declare(strict_types=1);

namespace Tests\Feature\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailValidator\Domain\Entity\EmailValidation;

class EmailValidationFixtures implements FixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $emailValidationValid = new EmailValidation('valid@email.com');
        $emailValidationInvalid = new EmailValidation('invalid email com');

        $manager->persist($emailValidationValid);
        $manager->persist($emailValidationInvalid);
        $manager->flush();
    }
}
