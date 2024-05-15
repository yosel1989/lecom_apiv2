<?php

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\TimeFormat;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;

final class CreateUseCase
{
    /**
     * @var CronogramaSalidaRepositoryContract
     */
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct( CronogramaSalidaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idCronograma,
        string $idVehiculo,
        string $fecha,
        string $hora,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {

        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idCronograma = new Id($idCronograma,false,'El id del cronograma no tiene el formato correcto');
        $_idVehiculo = new Id($idVehiculo,false,'El id del vehiculo no tiene el formato correcto');
        $_fecha = new DateFormat($fecha,false,'La fecha no tiene el formato correcto');
        $_hora = new TimeFormat($hora,false,'La hora no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_idCliente,
            $_idCronograma,
            $_idVehiculo,
            $_fecha,
            $_hora,
            $_idEstado,
            $_idUsuarioRegistro,
        );

    }
}
