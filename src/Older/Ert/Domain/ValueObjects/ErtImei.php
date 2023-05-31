<?php

declare(strict_types=1);

namespace Src\Older\Ert\Domain\ValueObjects;


use InvalidArgumentException;

final class ErtImei
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
        if( strlen( $value ) > 16 ){
            throw new InvalidArgumentException('Ert Imei cannot exceeding 16 characters');
        }
    }
}
