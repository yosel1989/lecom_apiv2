<?php

declare(strict_types=1);

namespace Src\Admin\Ert\Domain\ValueObjects;

use InvalidArgumentException;

final class ErtDeleted
{
    /**
     * @var int
     */
    private $value;

    public function __construct( int $value )
    {
        $this->validate( $value );
        $this->value = $value;
    }

    /**
     * @param int $value
     */
    private function validate( int $value ): void
    {
        if( !($value === 0 || $value ===1) ){
            throw new InvalidArgumentException( 'Ert deleted only value 0 or 1 ' );
        }
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
