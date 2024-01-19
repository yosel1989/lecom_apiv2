<?php

namespace Src\V2\EgresoTipo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\EgresoTipo\Domain\Contracts\EgresoTipoRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var EgresoTipoRepositoryContract
     */
    private EgresoTipoRepositoryContract $repository;

    public function __construct( EgresoTipoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEgresoTipo,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idEgresoTipo = new Id($idEgresoTipo,false,'El id del EgresoTipo no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idEgresoTipo,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
