<?php

declare(strict_types=1);

namespace Src\Admin\VehicleFleet\Domain\ValueObjects;


use InvalidArgumentException;

final class VehicleFleetDeleted
{
    /**
     * @var string
     */
    private $value;

    /**
     * VehicleFleetId constructor.
     * @param string $value
     */
    public function __construct( string $value )
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function value(): string{
        return $this->value;
    }

    /**
     * @param string $value
     */
    private function validate( string $value ): void
    {
        if( !($value === 0 || $value ===1) ){
            throw new InvalidArgumentException( 'Vehicle fleet deleted only value 0 or 1 ' );
        }
    }

}
