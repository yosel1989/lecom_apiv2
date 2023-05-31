<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Domain\ValueObjects;

use InvalidArgumentException;

final class VehicleDeleted
{
    /**
     * @var int
     */
    private $deleted;

    public function __construct( int $deleted )
    {
        $this->validate( $deleted );
        $this->deleted = $deleted;
    }

    /**
     * @param int $deleted
     */
    private function validate( int $deleted ): void
    {
        if( !($deleted === 0 || $deleted ===1) ){
            throw new InvalidArgumentException( 'Vehicle deleted only value 0 or 1 ' );
        }
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->deleted;
    }
}
