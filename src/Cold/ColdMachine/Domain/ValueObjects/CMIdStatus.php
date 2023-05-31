<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Domain\ValueObjects;

use InvalidArgumentException;

final class CMIdStatus
{
    /**
     * @var int
     */
    private $value;

    /**
     * ColdMachineId constructor.
     * @param int $value
     */
    public function __construct( int $value )
    {
        // $this->validate($value);
        $this->value = $value;
    }

    public function value(): int{
        return $this->value;
    }

    /**
     * @param int $value
     */
    private function validate( int $value ): void
    {
    }

}
