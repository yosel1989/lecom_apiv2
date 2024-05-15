<?php

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;

final class AnularCronogramaSalidaUseCase
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
        string $idUsuarioModifico
    ): void
    {
        $_idCronogramaSalida = new Id($idCronogramaSalida,false,'El id del CronogramaSalida no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');

        $this->repository->anular(
            $_idCronogramaSalida,
            $_idUsuarioModifico
        );

    }
}
