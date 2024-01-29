<?php

namespace Src\V2\Egreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var EgresoRepositoryContract
     */
    private EgresoRepositoryContract $repository;

    public function __construct( EgresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEgreso,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idEgreso = new Id($idEgreso,false,'El id del Egreso no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idEgreso,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
