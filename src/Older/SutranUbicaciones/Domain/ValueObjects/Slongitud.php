<?php

declare(strict_types=1);

namespace Src\Older\SutranUbicaciones\Domain\ValueObjects;


use InvalidArgumentException;

final class Slongitud
{
    private $value;

    public function __construct( float $value )
    {
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value();
    }
}
