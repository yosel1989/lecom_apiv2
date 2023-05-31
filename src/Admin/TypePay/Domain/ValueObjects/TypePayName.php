<?php

declare(strict_types=1);

namespace Src\Admin\TypePay\Domain\ValueObjects;

use InvalidArgumentException;

final class TypePayName
{
    /**
     * @var string
     */
    private $value;

    /**
     * TypePayId constructor.
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
        if( strlen( $value ) > 50 ){
            throw new InvalidArgumentException( 'Max Length type pay name 50 characters' . $value );
        }
    }

}
