<?php

declare(strict_types=1);

namespace Src\Older\Vehiculo\Domain\ValueObjects;


final class VehiculoId
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
}
