<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;

use InvalidArgumentException;

final class ClientPhone
{
    /**
     * @var string
     */
    private $phone;

    public function __construct(string $phone )
    {
        $this->validate( $phone );
        $this->phone = $phone;
    }

    /**
     * @param string $phone
     */
    private function validate(string $phone): void
    {
        if( strlen( $phone ) > 15 ){
            throw new InvalidArgumentException('Phone cannot exceeding 15 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->phone;
    }

}
