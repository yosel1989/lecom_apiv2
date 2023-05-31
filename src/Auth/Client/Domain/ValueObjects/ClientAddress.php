<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;

use InvalidArgumentException;

final class ClientAddress
{
    /**
     * @var string
     */
    private $address;

    public function __construct(string $address )
    {
        $this->validate( $address );
        $this->address = $address;
    }

    /**
     * @param string $address
     */
    private function validate(string $address): void
    {

        if( strlen( $address ) > 100 ){
            throw new InvalidArgumentException('Address cannot exceeding 100 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->address;
    }

}
