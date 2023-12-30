<?php

namespace Src\V2\ModuloMenu\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\ModuloMenu\Domain\Contracts\ModuloMenuRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var ModuloMenuRepositoryContract
     */
    private ModuloMenuRepositoryContract $repository;

    public function __construct( ModuloMenuRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idModuloMenu,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idModuloMenu = new Id($idModuloMenu,false,'El id del modulo no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idModuloMenu,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
