<?php 

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{

    public function __construct(
        protected string $value
    ) {
        $this->ensureIsValid($value);
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->value;
    }


    private function ensureIsValid($value)
    {
        if (!RamseyUuid::isValid($value))
            throw new InvalidArgumentException(sprintf('<%s> valor não permitido Uuid: <%s>', static::class, $value));     
    }

}