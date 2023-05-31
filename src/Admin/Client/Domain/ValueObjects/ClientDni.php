<?php

declare(strict_types=1);

namespace Src\Admin\Client\Domain\ValueObjects;

use InvalidArgumentException;

final class ClientDni
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value )
    {
        $this->validate( $value );
        $this->value = $value;
    }

    /**
     * @param string $value
     */
    private function validate(string $value): void
    {
        if( strlen( $value ) > 8 ){
            throw new InvalidArgumentException('Client Dni cannot exceeding 8 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
