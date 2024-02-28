<?php

declare(strict_types=1);

namespace Src\V2\EgresoDetalle\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoDetalle\Domain\Contracts\EgresoDetalleRepositoryContract;

final class GetReporteByClienteUseCase
{
    private EgresoDetalleRepositoryContract $repository;

    public function __construct(EgresoDetalleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fechaDesde, string $fechaHasta, ?string $idVehiculo, ?string $idPersonal): \Src\V2\EgresoDetalle\Domain\EgresoDetalleList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesde = new DateFormat($fechaDesde,false, 'El fecha inicio no tiene el formato correcto');
        $_fechaHasta= new DateFormat($fechaHasta,false, 'El fecha final no tiene el formato correcto');
        $_idVehiculo= new Id($idVehiculo,true, 'El id del vehiculo no tiene el formato correcto');
        $_idPersonal= new Id($idPersonal,true, 'El id del personal no tiene el formato correcto');
        return $this->repository->reporteByCliente($_idCliente, $_fechaDesde, $_fechaHasta, $_idVehiculo, $_idPersonal);
    }
}
