<?php

namespace Src\TransportePersonal\Paradero\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;
use Src\TransportePersonal\Paradero\Domain\Contracts\ParaderoRepositoryContract;
use Src\TransportePersonal\Paradero\Domain\ParaderoHora;

final class AssignHoursUseCase
{
    /**
     * @var ParaderoRepositoryContract
     */
    private $repository;

    public function __construct( ParaderoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        array $horas
    ): void
    {
        $id_paradero = new Id($id,false,'El id del Paradero no tiene el formato válido');
        $collection = [];

        foreach ($horas as $hora) {
            $collection[] = new ParaderoHora(
                new Id($hora["idRuta"],false,'El id de la ruta no tiene el formato valido'),
                new Id($hora["idTipoRuta"],false,'El id del tipo de ruta no tiene el formato valido'),
                new Numeric($hora["idTipoParadero"],false),
                new TimeFormat($hora["hora"],false,'La hora no tiene el formato válido'),
            );
        }

        $this->repository->assignHours(
            $id_paradero,
            $collection
        );

    }
}
