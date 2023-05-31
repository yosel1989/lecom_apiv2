<?php

namespace Src\TransportePersonal\Troncal\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\TransportePersonal\Troncal\Domain\Contracts\TroncalRepositoryContract;
use Src\TransportePersonal\Troncal\Domain\TroncalParadero;

final class AssignPointsUseCase
{
    /**
     * @var TroncalRepositoryContract
     */
    private $repository;

    public function __construct( TroncalRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        array $paraderos
    ): void
    {
        $id_tipo_ruta = new Id($id,false,'El id del Troncal no tiene el formato válido');
        $collection = [];

        foreach ($paraderos as $paradero) {
            $collection[] = new TroncalParadero(
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
