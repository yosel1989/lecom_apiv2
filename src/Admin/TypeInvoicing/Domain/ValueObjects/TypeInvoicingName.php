<?php

declare(strict_types=1);

namespace Src\Admin\TypeInvoicing\Domain\ValueObjects;

use InvalidArgumentException;

final class TypeInvoicingName
{
    /**
     * @var string
     */
    private $value;

    /**
     * TypeInvoicingId constructor.
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
            throw new InvalidArgumentException( 'Max Length type invoicing name 50 characters' . $value );
        }
    }

}
