<?php

namespace Src\V2\Usuario\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Usuario\Domain\Contracts\UsuarioRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var UsuarioRepositoryContract
     */
    private UsuarioRepositoryContract $repository;

    public function __construct( UsuarioRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idUsuario,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idUsuario = new Id($idUsuario,false,'El id del usuario no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idUsuario,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
