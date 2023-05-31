<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;


use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

final class ClientDni
{
    /**
     * @var string
     */
    private $dni;

    public function __construct(string $dni )
    {
        $this->validate( $dni );
        $this->dni = $dni;
    }

    /**
     * @param string $dni
     */
    private function validate(string $dni): void
    {
        if( strlen( $dni ) > 8 ){
            throw new InvalidArgumentException('Dni cannot exceeding 8 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->dni;
    }
}
