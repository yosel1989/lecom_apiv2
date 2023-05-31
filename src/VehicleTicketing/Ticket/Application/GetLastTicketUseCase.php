<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdClient;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineId;

final class GetLastTicketUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idTicketMachine): ?Ticket
    {
        $idTicketMachine = new TicketMachineId($idTicketMachine);
        return $this->repository->findLastTicketByTicketMachine($idTicketMachine);
    }
}
