<?php

declare(strict_types=1);

namespace Src\Auth\User\Domain\ValueObjects;


use InvalidArgumentException;

final class UserFirstName
{
    /**
     * @var string
     */
    private $firstName;

    public function __construct(string $firstName )
    {
        $this->validate( $firstName );
        $this->firstName = $firstName;
    }

    /**
     * @param string $firstName
     */
    private function validate(string $firstName): void
    {
        if( strlen( $firstName ) > 50 ){
            throw new InvalidArgumentException('First name cannot exceeding 50 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->firstName;
    }
}
