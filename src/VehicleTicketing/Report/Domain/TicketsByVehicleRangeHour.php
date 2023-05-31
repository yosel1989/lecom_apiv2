<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class TicketsByVehicleRangeHour
{
    /**
     * @var Id
     */
    private $idTicket;
    /**
     * @var float|int|Numeric
     */
    private $code;
    /**
     * @var float|int|Numeric
     */
    private $turn;
    /**
     * @var float|int|Numeric
     */
    private $latitude;
    /**
     * @var float|int|Numeric
     */
    private $longitude;
    /**
     * @var DateTimeFormat
     */
    private $date;
    /**
     * @var float|int|Numeric
     */
    private $amount;

    /**
     * TicketsByVehicleRangeHour constructor.
     * @param Id $idTicket
     * @param Numeric $code
     * @param Numeric $turn
     * @param Numeric $latitude
     * @param Numeric $longitude
     * @param DateTimeFormat $date
     * @param Numeric $amount
     */
    public function __construct(
        Id $idTicket,
        Numeric $code,
        Numeric $turn,
        Numeric $latitude,
        Numeric $longitude,
        DateTimeFormat $date,
        Numeric $amount
    )
    {

        $this->idTicket = $idTicket;
        $this->code = $code;
        $this->turn = $turn;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->date = $date;
        $this->amount = $amount;
    }

    /**
     * @return Id
     */
    public function getIdTicket(): Id
    {
        return $this->idTicket;
    }

    /**
     * @return float|int
     */
    public function getCode()
    {
        return $this->code;
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
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return float|int
     */
    public function getLongitude()
    {
        return $this->longitude;
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
    public function getAmount()
    {
        return $this->amount;
    }



}
