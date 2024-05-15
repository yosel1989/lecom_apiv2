<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaGroupTipoFechaShortList;

final class GetListByClienteGroupTipoFechaVehiculoUseCase
{
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct(CronogramaSalidaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fechaDesde, string $fechaHasta): CronogramaSalidaGroupTipoFechaShortList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesde = new DateFormat($fechaDesde,false, 'La fecha inicial no tiene el formato correcto');
        $_fechaHasta = new DateFormat($fechaHasta,false, 'La fecha final no tiene el formato correcto');
        return $this->repository->reporteByClienteGroupTipoFechaVehiculo($_idCliente, $_fechaDesde, $_fechaHasta);
    }
}
