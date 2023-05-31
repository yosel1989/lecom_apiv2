<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Domain\ValueObjects;


use InvalidArgumentException;

final class SimCardDeleted
{
    /**
     * @var int
     */
    private $value;

    /**
     * SimCardId constructor.
     * @param int $value
     */
    public function __construct( int $value )
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function value(): int{
        return $this->value;
    }

    /**
     * @param int $value
     */
    private function validate( int $value ): void
    {
        if( !($value === 0 || $value ===1) ){
            throw new InvalidArgumentException( 'Sim Card deleted only value 0 or 1 ' );
        }
    }

}
