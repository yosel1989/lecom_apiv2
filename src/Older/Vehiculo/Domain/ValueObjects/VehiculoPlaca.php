<?php

declare(strict_types=1);

namespace Src\Older\Vehiculo\Domain\ValueObjects;


use InvalidArgumentException;

final class VehiculoPlaca
{
    private $value;

    public function __construct( string $value )
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value();
    }

    private function validate( string $value ):void
    {
        if( strlen( $value ) > 50 ){
            throw new InvalidArgumentException('Vehiculo Placa cannot exceeding 50 characters');
        }
    }
}
