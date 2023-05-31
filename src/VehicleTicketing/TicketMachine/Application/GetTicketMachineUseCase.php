<?php


namespace Src\VehicleTicketing\TicketMachine\Application;



use Src\VehicleTicketing\TicketMachine\Domain\Contracts\TicketMachineRepositoryContract;
use Src\VehicleTicketing\TicketMachine\Domain\TicketMachine;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineId;

final class GetTicketMachineUseCase
{
    private $repository;

    public function __construct(TicketMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $ticketMachineId): ?TicketMachine
    {
        $id = new TicketMachineId($ticketMachineId);

        return $this->repository->find($id);
    }
}
