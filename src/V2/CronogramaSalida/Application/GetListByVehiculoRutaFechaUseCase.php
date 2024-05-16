<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaShortList;

final class GetListByVehiculoRutaFechaUseCase
{
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct(CronogramaSalidaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idVehiculo, string $idRuta, string $fecha): CronogramaSalidaShortList
    {
        $_idVehiculo = new Id($idVehiculo,false, 'El id del vehiculo no tiene el formato correcto');
        $_idRuta = new Id($idRuta,false, 'El id de la ruta no tiene el formato correcto');
        $_fecha = new DateFormat($fecha,false, 'La fecha no tiene el formato correcto');
        return $this->repository->listByVehiculoRutaFecha($_idVehiculo, $_idRuta, $_fecha);
    }
}
