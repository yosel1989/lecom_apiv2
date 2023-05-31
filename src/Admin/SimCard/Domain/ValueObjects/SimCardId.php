<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class SimCardId
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
        if( !Uuid::isValid($value) ){
            throw new InvalidArgumentException( 'Incorrect format sim card id ' . $value );
        }
    }

}
