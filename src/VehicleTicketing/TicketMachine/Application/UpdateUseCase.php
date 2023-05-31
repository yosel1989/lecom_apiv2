<?php


namespace Src\VehicleTicketing\TicketMachine\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\VehicleTicketing\TicketMachine\Domain\Contracts\TicketMachineRepositoryContract;


final class UpdateUseCase
{
    private $repository;

    public function __construct(TicketMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $imei,
        string $idClient,
        string $idVehicle,
        string $idUserCreated
    ): void
    {
        $_id = new Id($id, false, 'El id del boletero no tiene el formato correcto');
        $_imei = new Text($imei, false, 30, 'El imei excede los 30 digitos');
        $_idClient = new Id($idClient, false, 'El id del cliente no tiene el formato correcto');
        $_idVehicle = new Id($idVehicle, false, 'El id del vehiculo no tiene el formato correcto');
        $_idUserCreated = new Id($idUserCreated, false, 'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_id,
            $_imei,
            $_idClient,
            $_idVehicle,
            $_idUserCreated
        );
    }
}
