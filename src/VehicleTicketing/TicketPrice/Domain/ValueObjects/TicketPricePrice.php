<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketPrice\Domain\ValueObjects;

use InvalidArgumentException;

final class TicketPricePrice
{

    /**
     * @var float
     */
    private $price;

    public function __construct( float $price)
    {
        $this->validate( $price);
        $this->price = $price;
    }

    /**
     * @param float $price
     */
    private function validate( float $price): void
    {
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->price;
    }

}
