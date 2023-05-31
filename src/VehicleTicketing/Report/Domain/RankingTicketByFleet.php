<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Report\Domain;

use Src\ModelBase\Domain\ValueObjects\Numeric;

final class RankingTicketByFleet
{
    /**
     * @var float|int|Numeric
     */
    private $price;
    /**
     * @var float|int|Numeric
     */
    private $totalAmount;

    /**
     * @param Numeric $price
     * @param Numeric $totalAmount
     */
    public function __construct(
        Numeric $price,
        Numeric $totalAmount
    )
    {

        $this->price = $price;
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return float|int|string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return float|int|string
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }



}
