<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;


final class TicketLongitude
{
    /**
     * @var float
     */
    private $longitud;

    public function __construct(float $longitud )
    {
        $this->validate( $longitud );
        $this->longitud = $longitud;
    }

    /**
     * @param float $longitud
     */
    private function validate(float $longitud): void
    {

    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->longitud;
    }

}
