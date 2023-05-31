<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlertHistory\Domain\ValueObjects;

use InvalidArgumentException;

final class CMAHAttended
{
    /**
     * @var int
     */
    private $value;

    /**
     * ColdMachineAlertHistoryId constructor.
     * @param int|null $value
     */
    public function __construct( ?int $value )
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function value(): ?int{
        return $this->value;
    }

    /**
     * @param int|null $value
     */
    private function validate( ?int $value ): void
    {
        if(is_null($value)){ return;}
        if(!($value === 0 || $value === 1)){
            throw new InvalidArgumentException( 'Status Cold Machine Alert History attended only accept 0 or 1 ' . $value );
        }
    }

}
