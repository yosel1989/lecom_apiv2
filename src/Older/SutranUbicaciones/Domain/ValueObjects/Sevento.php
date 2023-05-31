<?php

declare(strict_types=1);

namespace Src\Older\SutranUbicaciones\Domain\ValueObjects;


use InvalidArgumentException;

final class Sevento
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
            throw new InvalidArgumentException('SutranUbicaciones Evento cannot exceeding 50 characters');
        }
    }
}
