<?php

declare(strict_types=1);

namespace Src\Admin\VehicleClass\Domain\ValueObjects;


use InvalidArgumentException;

final class VehicleClassDeleted
{
    /**
     * @var int
     */
    private $value;

    /**
     * VehicleClassId constructor.
     * @param int $value
     */
    public function __construct( int $value )
    {
        $this->validate($value);
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
        if( !($value === 0 || $value ===1) ){
            throw new InvalidArgumentException( 'Vehicle class deleted only value 0 or 1 ' );
        }
    }

}
