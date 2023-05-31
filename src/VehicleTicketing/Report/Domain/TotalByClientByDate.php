<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class TotalByClientByDate
{
    /**
     * @var Id
     */
    private $idVehicle;
    /**
     * @var Text
     */
    private $unit;
    /**
     * @var Text
     */
    private $plate;
    /**
     * @var Text
     */
    private $property;
    /**
     * @var float|int|Numeric|string
     */
    private $totalTicket;
    /**
     * @var float|int|Numeric|string
     */
    private $totalAmount;
    /**
     * @var float|int|Numeric|string
     */
    private $totalTurn;

    /**
     * Ticket constructor.
     * @param Id $idVehicle
     * @param Text $unit
     * @param Text $plate
     * @param Text $property
     * @param Numeric $totalTurn
     * @param Numeric $totalTicket
     * @param Numeric $totalAmount
     */
    public function __construct(
        Id $idVehicle,
        Text $unit,
        Text $plate,
        Text $property,
        Numeric $totalTurn,
        Numeric $totalTicket,
        Numeric $totalAmount
    )
    {

        $this->idVehicle = $idVehicle;
        $this->unit = $unit;
        $this->plate = $plate;
        $this->property = $property;
        $this->totalTicket = $totalTicket;
        $this->totalAmount = $totalAmount;
        $this->totalTurn = $totalTurn;
    }

    /**
     * @return Id
     */
    public function getIdVehicle(): Id
    {
        return $this->idVehicle;
    }

    /**
     * @return Text
     */
    public function getUnit(): Text
    {
        return $this->unit;
    }

    /**
     * @return Text
     */
    public function getPlate(): Text
    {
        return $this->plate;
    }

    /**
     * @return Text
     */
    public function getProperty(): Text
    {
        return $this->property;
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

    /**
     * @return float|int
     */
    public function getTotalTurn()
    {
        return $this->totalTurn;
    }


}
