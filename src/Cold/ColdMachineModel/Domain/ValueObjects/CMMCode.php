<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineModel\Domain\ValueObjects;

use InvalidArgumentException;

final class CMMCode
{
    /**
     * @var int
     */
    private $value;

    /**
     * ColdMachineModelId constructor.
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
