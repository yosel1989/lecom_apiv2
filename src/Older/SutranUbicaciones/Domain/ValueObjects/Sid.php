<?php

declare(strict_types=1);

namespace Src\Older\SutranUbicaciones\Domain\ValueObjects;


final class Sid
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
