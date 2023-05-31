<?php

declare(strict_types=1);

namespace Src\Auth\User\Domain\ValueObjects;


use InvalidArgumentException;

final class UserPhone
{
    /**
     * @var string
     */
    private $value;

    public function __construct( ?string $value )
    {
        $this->validate( $value );
        $this->value = $value;
    }

    /**
     * @param string|null $value
     */
    private function validate( ?string $value): void
    {
        if(is_null($value)){return;}
        if( strlen( $value ) > 15 ){
            throw new InvalidArgumentException('Phone cannot exceeding 15 characters');
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
