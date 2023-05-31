<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketId;

final class GetTicketUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $ticketId): ?Ticket
    {
        $id = new TicketId($ticketId);
        return $this->repository->findWithRelations($id,['idClient_pk','idMachine_pk','idPrice_pk','idType_pk','idVehicle_pk']);
    }
}
