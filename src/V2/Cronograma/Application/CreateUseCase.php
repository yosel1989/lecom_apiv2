<?php

namespace Src\V2\Cronograma\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Cronograma\Domain\Contracts\CronogramaRepositoryContract;

final class CreateUseCase
{
    /**
     * @var CronogramaRepositoryContract
     */
    private CronogramaRepositoryContract $repository;

    public function __construct( CronogramaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idSede,
        int $idTipoRuta,
        string $idRuta,
        string $fecha,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {

        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false,'El id de la sede no tiene el formato correcto');
        $_idTipoRuta = new NumericInteger($idTipoRuta);
        $_idRuta = new Id($idRuta,false,'El id de la ruta no tiene el formato correcto');
        $_fecha = new DateFormat($fecha,false,'La fecha no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_idCliente,
            $_idSede,
            $_idTipoRuta,
            $_idRuta,
            $_fecha,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
