<?php

declare(strict_types=1);

namespace Src\Auth\User\Domain\ValueObjects;


use InvalidArgumentException;

final class UserLastName
{
    /**
     * @var string
     */
    private $lastName;

    public function __construct(string $lastName )
    {
        $this->validate( $lastName );
        $this->lastName = $lastName;
    }

    /**
     * @param string $lastName
     */
    private function validate(string $lastName): void
    {
        if( strlen( $lastName ) > 50 ){
            throw new InvalidArgumentException('Last name cannot exceeding 50 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->lastName;
    }
}
