<?php

namespace Src\V2\EgresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\EgresoCategoria\Domain\Contracts\EgresoCategoriaRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var EgresoCategoriaRepositoryContract
     */
    private EgresoCategoriaRepositoryContract $repository;

    public function __construct( EgresoCategoriaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEgresoCategoria,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idEgresoCategoria = new Id($idEgresoCategoria,false,'El id del EgresoCategoria no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idEgresoCategoria,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
