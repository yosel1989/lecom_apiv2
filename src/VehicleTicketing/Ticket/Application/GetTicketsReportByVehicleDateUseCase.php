<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;

final class GetTicketsReportByVehicleDateUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( TicketIdVehicle $ticketIdVehicle, string $start, string $end )
    {
        return $this->repository->getTicketsReportByVehicleDateWithRelations($start,$end,$ticketIdVehicle,['idClient_pk','idMachine_pk','idPrice_pk','idType_pk','idVehicle_pk']);
    }

}
