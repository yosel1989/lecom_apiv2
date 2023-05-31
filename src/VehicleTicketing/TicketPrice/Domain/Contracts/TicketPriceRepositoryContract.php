<?php


namespace Src\VehicleTicketing\TicketPrice\Domain\Contracts;




use Src\VehicleTicketing\TicketPrice\Domain\TicketPrice;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceCode;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceId;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceIdClient;

interface TicketPriceRepositoryContract
{
    public function find(TicketPriceId $id): ?TicketPrice;

    public function findByCriteria( TicketPriceCode $code , TicketPriceIdClient $idClient ): ?TicketPrice;

}
