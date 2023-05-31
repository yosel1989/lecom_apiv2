<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineHistory\Domain\ValueObjects;

use InvalidArgumentException;

final class CMHHumidity
{
    /**
     * @var float
     */
    private $value;

    /**
     * ColdMachineHistoryId constructor.
     * @param float|null $value
     */
    public function __construct( ?float $value )
    {
//        $this->validate($value);
        $this->value = $value;
    }

    public function value(): ?float{
        return $this->value;
    }

    /**
     * @param float|null $value
     */
    private function validate( ?float $value ): void
    {
        if(is_null($value)){ return;}
        if(!($value === 0 || $value === 1)){
            throw new InvalidArgumentException( 'Status Cold Machine History only accept 0 or 1 ' . $value );
        }
    }

}
