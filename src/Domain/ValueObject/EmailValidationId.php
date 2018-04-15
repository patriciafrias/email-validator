<?php
declare(strict_types=1);

namespace EmailValidator\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

final class EmailValidationId
{
    /** @var string */
    private $value;

    public function __construct(string $value = null)
    {
        if (!is_null($value)) {
            $this->value = Uuid::fromString($value)->toString();
        } else {
            $this->value = Uuid::uuid4()->toString();
        }
    }

    public static function create($value = null): self
    {
        return new static($value);
    }

    public function id(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->id();
    }
}
