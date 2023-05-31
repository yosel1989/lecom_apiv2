<?php


namespace Src\VehicleTicketing\TicketType\Domain\Contracts;


use Src\VehicleTicketing\TicketType\Domain\TicketType;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeCode;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeId;

interface TicketTypeRepositoryContract
{
    public function find(TicketTypeId $id): ?TicketType;

    public function findByCode(TicketTypeCode $code): ?TicketType;

    public function collection(): array;

}
