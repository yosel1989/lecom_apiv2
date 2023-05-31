<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Domain\ValueObjects;

use InvalidArgumentException;

final class SimCardDetail
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
        if( strlen( $value ) > 50 ){
            throw new InvalidArgumentException( 'Max Length Sim Card detail 50 characters ' . $value );
        }
    }

}
