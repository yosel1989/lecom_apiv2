<?php

declare(strict_types=1);

namespace Src\Admin\VehicleFleet\Domain\ValueObjects;


use InvalidArgumentException;

final class VehicleFleetName
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
        if( strlen( $value ) > 100 ){
            throw new InvalidArgumentException( 'Max Length vehicle fleet name 100 characters' . $value );
        }
    }

}
