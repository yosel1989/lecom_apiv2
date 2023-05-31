<?php


namespace Src\Administracion\Ingreso\Application;

use Src\Administracion\Ingreso\Domain\Contracts\IngresoRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetReportByClientUseCase
{
    private $repository;

    public function __construct(IngresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $fechaDesde, string $fechaHasta, string $idVehiculo, string $idCliente ): array
    {
        $FechaInicio = new DateOnlyFormat($fechaDesde,false,'La fecha inicio no tiene un formato válido');
        $FechaFin = new DateOnlyFormat($fechaHasta,false,'La fecha final no tiene un formato válido');
        $IdVehiculo = new Id($idVehiculo,false,'El id del vehiculo no tiene el formato válido');
        $IdCliente = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->report($FechaInicio, $FechaFin, $IdVehiculo, $IdCliente);
    }

}
