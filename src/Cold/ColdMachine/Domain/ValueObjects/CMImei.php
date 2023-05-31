<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Domain\ValueObjects;

use InvalidArgumentException;

final class CMImei
{
    /**
     * @var string
     */
    private $value;

    /**
     * ColdMachineId constructor.
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
        if( strlen( $value ) > 50 ){
            throw new InvalidArgumentException( 'Max Length Cold Machine imei 50 characters ' . $value );
        }
    }

}
