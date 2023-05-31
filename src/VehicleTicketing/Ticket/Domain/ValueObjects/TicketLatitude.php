<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;


final class TicketLatitude
{
    /**
     * @var float
     */
    private $latitude;

    public function __construct(float $latitude )
    {
        $this->validate( $latitude );
        $this->latitude = $latitude;
    }

    /**
     * @param float $latitude
     */
    private function validate(float $latitude): void
    {

    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->latitude;
    }

}
