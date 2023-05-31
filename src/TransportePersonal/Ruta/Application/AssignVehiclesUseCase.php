<?php

namespace Src\TransportePersonal\Ruta\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\TransportePersonal\Ruta\Domain\RutaVehiculo;

final class AssignVehiclesUseCase
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
        string $id,
        array $vehiculos
    ): void
    {
        $id_ruta = new Id($id,false,'El id del Ruta no tiene el formato válido');
        $collection = [];

        foreach ($vehiculos as $vehiculo) {
            $collection[] = new RutaVehiculo(
                new Id($vehiculo['idRuta'],false,'El id de la ruta no tiene el formato válido'),
                new Id($vehiculo['idVehiculo'],false,'El id del vehiculo no tiene el formato válido'),
            );
        }

        $this->repository->assignVehicles(
            $id_ruta,
            $collection
        );

    }
}
