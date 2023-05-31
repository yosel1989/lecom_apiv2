<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Domain\ValueObjects;

use InvalidArgumentException;

final class SimCardImei
{
    /**
     * @var string
     */
    private $value;

    /**
     * SimCardId constructor.
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
        if(is_null($value)){return;}
        if( strlen( $value ) > 20 ){
            throw new InvalidArgumentException( 'Max Length Sim Card imei 20 characters ' . $value );
        }
    }

}
