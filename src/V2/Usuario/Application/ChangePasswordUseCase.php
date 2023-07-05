<?php

namespace Src\V2\Usuario\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Usuario\Domain\Contracts\UsuarioRepositoryContract;

final class ChangePasswordUseCase
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
        string $clave,
        string $idUsuarioModifico
    ): void
    {
        $_idUsuario = new Id($idUsuario,false,'El id del usuario no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_clave = new Text($clave,false, 15,'La contraseña excede los 15 caracteres');

        $this->repository->changePassword(
            $_idUsuario,
            $_clave,
            $_idUsuarioModifico
        );

    }
}
