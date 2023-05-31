<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class TotalByVehicle
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
    private $days;
    /**
     * @var float|int|Numeric|string
     */
    private $totalAmount;

    /**
     * Ticket constructor.
     * @param Id $idVehicle
     * @param Text $unit
     * @param Text $plate
     * @param Text $property
     * @param Numeric $totalTicket
     * @param Numeric $days
     * @param Numeric $totalAmount
     */
    public function __construct(
        Id $idVehicle,
        Text $unit,
        Text $plate,
        Text $property,
        Numeric $totalTicket,
        Numeric $days,
        Numeric $totalAmount
    )
    {

        $this->idVehicle = $idVehicle;
        $this->unit = $unit;
        $this->plate = $plate;
        $this->property = $property;
        $this->totalTicket = $totalTicket;
        $this->days = $days;
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
     * @return float|int|string
     */
    public function getTotalTicket()
    {
        return $this->totalTicket;
    }

    /**
     * @return float|int|string
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @return float|int|string
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }


}
