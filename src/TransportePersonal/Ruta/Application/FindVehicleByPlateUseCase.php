<?php

namespace Src\TransportePersonal\Ruta\Application;

use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\TransportePersonal\Ruta\Domain\RutaVehiculo;

final class FindVehicleByPlateUseCase
{
    /**
     * @var RutaRepositoryContract
     */
    private $repository;

    public function __construct( RutaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $placa
    ): ?RutaVehiculo
    {
        $p = new Text($placa,false,10,'La placa del vehiculo excede los 10 caracteres');

        return $this->repository->findVehicleByPlate(
            $p
        );

    }
}
