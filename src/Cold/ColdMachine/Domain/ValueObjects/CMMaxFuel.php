<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Domain\ValueObjects;

use InvalidArgumentException;

final class CMMaxFuel
{
    /**
     * @var float
     */
    private $value;

    /**
     * ColdMachineId constructor.
     * @param float $value
     */
    public function __construct( float $value )
    {
        // $this->validate($value);
        $this->value = $value;
    }

    public function value(): float{
        return $this->value;
    }

    /**
     * @param float $value
     */
    private function validate( float $value ): void
    {
    }

}
