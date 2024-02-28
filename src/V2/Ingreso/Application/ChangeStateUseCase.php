<?php

namespace Src\V2\Ingreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Ingreso\Domain\Contracts\IngresoRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var IngresoRepositoryContract
     */
    private IngresoRepositoryContract $repository;

    public function __construct( IngresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idIngreso,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idIngreso = new Id($idIngreso,false,'El id del Ingreso no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idIngreso,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
