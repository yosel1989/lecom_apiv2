<?php


namespace Src\VehicleTicketing\Ticket\Application;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;

final class GetLiquidacionDiariaBusUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fecha, string $idVehiculo): array
    {
        $IdCliente = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        $date = new DateOnlyFormat($fecha,false,'La fecha tiene un formato inválido');
        $IdVehiculo = new Id($idVehiculo,false,'El id del vehiculo no tiene el formato válido');
//        $IdPersonal = new Id($idPersonal,false,'El id del personal no tiene el formato válido');

        return $this->repository->liquidacionDiariaBus($date, $IdCliente, $IdVehiculo);
    }

}
