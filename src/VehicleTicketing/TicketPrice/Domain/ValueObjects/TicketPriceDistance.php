<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketPrice\Domain\ValueObjects;

use InvalidArgumentException;

final class TicketPriceDistance
{

    /**
     * @var int
     */
    private $distance;

    public function __construct( int $distance)
    {
        $this->distance = $distance;
    }


    /**
     * @return int
     */
    public function value(): int
    {
        return $this->distance;
    }

}
