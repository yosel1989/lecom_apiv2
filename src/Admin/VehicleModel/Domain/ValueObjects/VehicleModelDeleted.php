<?php

declare(strict_types=1);

namespace Src\Admin\VehicleModel\Domain\ValueObjects;


use InvalidArgumentException;

final class VehicleModelDeleted
{
    /**
     * @var int
     */
    private $value;

    /**
     * VehicleModelId constructor.
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
            throw new InvalidArgumentException( 'Vehicle model deleted only value 0 or 1 ' );
        }
    }

}
