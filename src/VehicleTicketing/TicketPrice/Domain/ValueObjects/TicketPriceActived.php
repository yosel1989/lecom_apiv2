<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketPrice\Domain\ValueObjects;

use InvalidArgumentException;

final class TicketPriceActived
{

    /**
     * @var int
     */
    private $actived;

    public function __construct( int $actived)
    {
        $this->validate( $actived);
        $this->actived = $actived;
    }

    /**
     * @param int $actived
     */
    private function validate( int $actived): void
    {
        if( !($actived===0 || $actived ===1)){
            throw new InvalidArgumentException( 'TicketPriceActived only accept value 0 or 1 ' );
        }
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->actived;
    }

}
