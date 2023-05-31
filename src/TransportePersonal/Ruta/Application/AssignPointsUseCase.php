<?php

namespace Src\TransportePersonal\Ruta\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\TransportePersonal\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\TransportePersonal\Ruta\Domain\RutaParadero;

final class AssignPointsUseCase
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
        array $paraderos
    ): void
    {
        $id_tipo_ruta = new Id($id,false,'El id del Ruta no tiene el formato válido');
        $collection = [];

        foreach ($paraderos as $paradero) {
            $collection[] = new RutaParadero(
                new Id($paradero['idTipoRuta'],false,'El id del tipo de ruta no tiene el formato válido'),
                new Id($paradero['idParadero'],false,'El id del paradero no tiene el formato válido'),
                new Numeric($paradero['idTipoParadero'],false)
            );
        }

        $this->repository->assignPoints(
            $id_tipo_ruta,
            $collection
        );

    }
}
