<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class TotalAverageByFleetByHourRangeDate
{
    /**
     * @var DateTimeFormat
     */
    private  $date;
    /**
     * @var Text
     */
    private  $hour;
    /**
     * @var float|int|Numeric
     */
    private $averageAmount;

    /**
     * @param DateTimeFormat $date
     * @param Text $hour
     * @param Numeric $averageAmount
     */
    public function __construct(
        DateTimeFormat $date,
        Text $hour,
        Numeric $averageAmount
    )
    {

        $this->date = $date;
        $this->hour = $hour;
        $this->averageAmount = $averageAmount;
    }

    /**
     * @return DateTimeFormat
     */
    public function getDate(): DateTimeFormat
    {
        return $this->date;
    }

    /**
     * @return Text
     */
    public function getHour(): Text
    {
        return $this->hour;
    }

    /**
     * @return float|int
     */
    public function getAverageAmount()
    {
        return $this->averageAmount;
    }



}
