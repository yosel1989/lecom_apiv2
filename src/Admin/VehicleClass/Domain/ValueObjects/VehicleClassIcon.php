<?php

declare(strict_types=1);

namespace Src\Admin\VehicleClass\Domain\ValueObjects;


use InvalidArgumentException;

final class VehicleClassIcon
{
    /**
     * @var string
     */
    private $value;

    /**
     * VehicleClassId constructor.
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
        if( strlen( $value ) > 30 ){
            throw new InvalidArgumentException( 'Max Length vehicle class icon 30 characters' . $value );
        }
    }

}
