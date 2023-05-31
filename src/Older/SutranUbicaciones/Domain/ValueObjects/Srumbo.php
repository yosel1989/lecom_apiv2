<?php

declare(strict_types=1);

namespace Src\Older\SutranUbicaciones\Domain\ValueObjects;


use InvalidArgumentException;

final class Srumbo
{
    private $value;

    public function __construct( int $value )
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value();
    }

    private function validate( int $value ):void
    {
        if( strlen( $value ) > 50 ){
            throw new InvalidArgumentException('SutranUbicaciones Placa cannot exceeding 50 characters');
        }
    }
}
