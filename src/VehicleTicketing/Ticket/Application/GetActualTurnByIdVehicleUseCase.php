<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;

final class GetActualTurnByIdVehicleUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): ?int
    {
        $idVehicle = new TicketIdVehicle($id);
        return $this->repository->getTurnActualByIdVehicle($idVehicle);
    }
}
