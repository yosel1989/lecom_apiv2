<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;

use InvalidArgumentException;

final class TicketTurn
{
    /**
     * @var int
     */
    private $turn;

    public function __construct( int $turn )
    {
        $this->validate( $turn );
        $this->turn = $turn;
    }

    /**
     * @param int $turn
     */
    private function validate( int $turn ): void
    {
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->turn;
    }
}
