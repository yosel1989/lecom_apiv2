<?php

namespace Src\V2\IngresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\IngresoCategoria\Domain\Contracts\IngresoCategoriaRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var IngresoCategoriaRepositoryContract
     */
    private IngresoCategoriaRepositoryContract $repository;

    public function __construct( IngresoCategoriaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idIngresoCategoria,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idIngresoCategoria = new Id($idIngresoCategoria,false,'El id de la categoria no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idIngresoCategoria,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
