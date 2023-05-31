<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCode;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketDate;

final class GetTicketByCodeAndDateUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $ticketCode, string $ticketDate): ?Ticket
    {
        $code = new TicketCode($ticketCode);
        $date = new TicketDate($ticketDate);
        return $this->repository->findByCodeDate($code,$date,['idClient_pk','idMachine_pk','idPrice_pk','idType_pk','idVehicle_pk']);
    }
}
