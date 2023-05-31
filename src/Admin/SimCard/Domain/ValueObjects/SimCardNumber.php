<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Domain\ValueObjects;

use InvalidArgumentException;

final class SimCardNumber
{
    /**
     * @var string
     */
    private $value;

    /**
     * SimCardId constructor.
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
        if( strlen( $value ) > 20 ){
            throw new InvalidArgumentException( 'Max Length sim card name 20 characters ' . $value );
        }

        if( !is_numeric( $value ) ){
            throw new InvalidArgumentException( 'Sim card number only number ' . $value );
        }
    }

}
