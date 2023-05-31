<?php

namespace Src\TransportePersonal\TipoRuta\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\TransportePersonal\TipoRuta\Domain\Contracts\TipoRutaRepositoryContract;
use Src\TransportePersonal\TipoRuta\Domain\TipoRutaParadero;

final class AssignPointsUseCase
{
    /**
     * @var TipoRutaRepositoryContract
     */
    private $repository;

    public function __construct( TipoRutaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        array $paraderos
    ): void
    {
        $id_tipo_ruta = new Id($id,false,'El id del TipoRuta no tiene el formato válido');
        $collection = [];

        foreach ($paraderos as $paradero) {
            $collection[] = new TipoRutaParadero(
                new Id($paradero['idParadero'],false,'El id del paradero no tiene el formato válido'),
                new Numeric($paradero['idTipo'],false)
            );
        }

        $this->repository->assignPoints(
            $id_tipo_ruta,
            $collection
        );

    }
}
