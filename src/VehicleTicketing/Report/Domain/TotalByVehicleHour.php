<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;

final class TotalByVehicleHour
{

    /**
     * @var DateTimeFormat
     */
    private $date;
    /**
     * @var float|int|Numeric
     */
    private $totalAmount;

    /**
     * TotalByVehicleHour constructor.
     * @param Id $idVehicle
     * @param DateTimeFormat $date
     * @param Numeric $totalAmount
     */
    public function __construct(
        DateTimeFormat $date,
        Numeric $totalAmount
    )
    {
        $this->date = $date;
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
     * @return float|int
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }



}
