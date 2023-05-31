<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlert\Domain\ValueObjects;

use InvalidArgumentException;

final class CMADescription
{
    /**
     * @var string
     */
    private $value;

    /**
     * ColdMachineAlertId constructor.
     * @param string|null $value
     */
    public function __construct( ?string $value )
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function value(): ?string{
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    private function validate( ?string $value ): void
    {
        if(is_null($value)){return;}
        if( strlen( $value ) > 100 ){
            throw new InvalidArgumentException( 'Max Length Cold Machine Alert description 100 characters ' . $value );
        }
    }

}
