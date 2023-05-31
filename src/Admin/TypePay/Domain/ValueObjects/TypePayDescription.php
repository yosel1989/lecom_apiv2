<?php

declare(strict_types=1);

namespace Src\Admin\TypePay\Domain\ValueObjects;

use InvalidArgumentException;

final class TypePayDescription
{
    /**
     * @var string
     */
    private $value;

    /**
     * TypePayId constructor.
     * @param string|null $value
     */
    public function __construct( ?string $value )
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function value(): ?string{
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    private function validate( ?string $value ): void
    {
        if(is_null($value)){
            return;
        }
        if( strlen( $value ) > 150 ){
            throw new InvalidArgumentException( 'Max Length type pay description 150 characters' . $value );
        }
    }

}
