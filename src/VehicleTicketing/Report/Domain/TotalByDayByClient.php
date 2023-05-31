<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class TotalByDayByClient
{
    /**
     * @var DateTimeFormat
     */
    private $date;
    /**
     * @var float|int|Numeric|string
     */
    private $countVehicle;
    /**
     * @var float|int|Numeric|string
     */
    private $countTicket;
    /**
     * @var float|int|Numeric|string
     */
    private $totalAmount;

    /**
     * TotalByDayByClient constructor.
     * @param DateTimeFormat $date
     * @param Numeric $countVehicle
     * @param Numeric $countTicket
     * @param Numeric $totalAmount
     */
    public function __construct(
        DateTimeFormat $date,
        Numeric $countVehicle,
        Numeric $countTicket,
        Numeric $totalAmount
    )
    {


        $this->date = $date;
        $this->countVehicle = $countVehicle;
        $this->countTicket = $countTicket;
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return DateTimeFormat
     */
    public function getDate(): DateTimeFormat
    {
        return $this->date;
    }

    /**
     * @return float|int|string
     */
    public function getCountVehicle()
    {
        return $this->countVehicle;
    }

    /**
     * @return float|int|string
     */
    public function getCountTicket()
    {
        return $this->countTicket;
    }

    /**
     * @return float|int|string
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

}
