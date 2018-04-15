<?php
declare(strict_types=1);

namespace EmailValidator\Infrastructure\Adapter\Doctrine;

use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use EmailValidator\Domain\Entity\EmailValidation;
use EmailValidator\Domain\Port\EmailValidationRepositoryInterface;

class DoctrineEmailValidationRepositoryAdapter implements EmailValidationRepositoryInterface
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(EmailValidation::class)->findAll();
    }

    public function getReport(): array
    {
        $sql = " 
            SELECT
                DATE_FORMAT( validated_timestamp, '%Y-%m-%d' ) AS short_date,
                SUM( IF ( is_valid_email = '1', 1, 0 ) ) AS valid_emails,
                SUM( IF ( is_valid_email = '0', 1, 0 ) ) AS invalid_emails
            FROM
                email_validations
            GROUP BY
                short_date
            ORDER BY
                short_date DESC
        ";

        $stmt = $this->entityManager->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findOneByEmailAndDate(string $email): ? EmailValidation
    {
        $date = new DateTimeImmutable();

        $validationDate = $date->format('Y-m-d');

        $query = $this->entityManager->getRepository(EmailValidation::class)
            ->createQueryBuilder('v')
            ->where('v.validatedTimestamp LIKE :validatedDate')
            ->setParameter('validatedDate', "%$validationDate%")
            ->andWhere('v.email = :email')
            ->setParameter('email', $email)
            ->getQuery();

        $result = $query->getResult();

        if ($result) {
            return $result[0];
        }

        return null;
    }

    public function add(EmailValidation $emailValidation): void
    {
        $this->entityManager->persist($emailValidation);
        $this->entityManager->flush();
    }
}
