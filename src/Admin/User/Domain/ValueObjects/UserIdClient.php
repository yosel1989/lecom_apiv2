<?php

declare(strict_types=1);

namespace Src\Admin\User\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class UserIdClient
{
    /**
     * @var string
     */
    private $value;

    /**
     * UserIdUser constructor.
     * @param string|null $value
     */
    public function __construct(?string $value )
    {
        $this->validate( $value );
        $this->value = $value;
    }

    /**
     * @param string|null $value
     */
    private function validate( ?string $value ): void
    {
        if ( is_null($value) ){return;}
        if( !Uuid::isValid($value) ){
            throw new InvalidArgumentException( 'Does not allow the invalid format id User');
        }

    }

    /**
     * @return string|null
     */
    public function value(): ?string
    {
        return $this->value;
    }
}
