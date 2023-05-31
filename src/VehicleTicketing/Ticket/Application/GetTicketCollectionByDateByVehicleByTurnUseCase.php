<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketTurn;

final class GetTicketCollectionByDateByVehicleByTurnUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $date, TicketIdVehicle $ticketIdVehicle, TicketTurn $ticketTurn) : array
    {
        return $this->repository->getTicketsCollectionByDateByVehicleByTurnWithRelations( $date,$ticketIdVehicle,$ticketTurn,['idClient_pk','idMachine_pk','idPrice_pk','idType_pk','idVehicle_pk']);
    }

}
