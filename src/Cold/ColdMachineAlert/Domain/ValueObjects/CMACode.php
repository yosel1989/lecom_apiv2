<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlert\Domain\ValueObjects;

use InvalidArgumentException;

final class CMACode
{
    /**
     * @var int
     */
    private $value;

    /**
     * ColdMachineAlertId constructor.
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
