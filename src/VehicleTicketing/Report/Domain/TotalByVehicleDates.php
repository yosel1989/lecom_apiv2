<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;


use Src\ModelBase\Domain\ValueObjects\DateFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;

final class TotalByVehicleDates
{
    /**
     * @var Id
     */
    private $idVehicle;
    /**
     * @var DateFormat
     */
    private $date;
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
     * TotalByVehicleDates constructor.
     * @param Id $idVehicle
     * @param DateFormat $date
     * @param Numeric $turn
     * @param Numeric $totalTicket
     * @param Numeric $totalAmount
     */
    public function __construct(
        Id $idVehicle,
        DateFormat $date,
        Numeric $turn,
        Numeric $totalTicket,
        Numeric $totalAmount
    )
    {

        $this->idVehicle = $idVehicle;
        $this->date = $date;
        $this->turn = $turn;
        $this->totalTicket = $totalTicket;
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return Id
     */
    public function getIdVehicle(): Id
    {
        return $this->idVehicle;
    }

    /**
     * @return DateFormat
     */
    public function getDate(): DateFormat
    {
        return $this->date;
    }

    /**
     * @return float|int
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @return float|int
     */
    public function getTotalTicket()
    {
        return $this->totalTicket;
    }

    /**
     * @return float|int
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }



}
