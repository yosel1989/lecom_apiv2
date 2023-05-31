<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;

use Src\ModelBase\Domain\ValueObjects\Numeric;

final class TotalByVehicleByTurn
{
    /**
     * @var float|int|Numeric
     */
    private $turn;
    /**
     * @var float|int|Numeric
     */
    private $totalTicket;
    /**
     * @var float|int|Numeric
     */
    private $totalAmount;

    /**
     * @param Numeric $turn
     * @param Numeric $totalTicket
     * @param Numeric $totalAmount
     */
    public function __construct(
        Numeric $turn,
        Numeric $totalTicket,
        Numeric $totalAmount
    )
    {
        $this->turn = $turn;
        $this->totalTicket = $totalTicket;
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return float|int|string
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @return float|int|string
     */
    public function getTotalTicket()
    {
        return $this->totalTicket;
    }

    /**
     * @return float|int|string
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }



}
