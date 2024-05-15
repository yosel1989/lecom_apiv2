<?php

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;

final class ChangeStateUseCase
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
        string $idCronogramaSalida,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idCronogramaSalida = new Id($idCronogramaSalida,false,'El id de la salida no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idCronogramaSalida,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
