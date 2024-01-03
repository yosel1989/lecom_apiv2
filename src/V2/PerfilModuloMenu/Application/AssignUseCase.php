<?php

namespace Src\V2\PerfilModuloMenu\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\PerfilModuloMenu\Domain\Contracts\PerfilModuloMenuRepositoryContract;

final class AssignUseCase
{
    /**
     * @var PerfilModuloMenuRepositoryContract
     */
    private PerfilModuloMenuRepositoryContract $repository;

    public function __construct( PerfilModuloMenuRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idPerfil,
        int $idModulo,
        array $menu,
        string $idUsuario
    ): void
    {
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idPerfil = new Id($idPerfil,false,'El id del perfil no tiene el formato correcto');
        $_idModulo = new NumericInteger($idModulo);
        $_menu = $menu;
        $_idUsuario = new Id($idUsuario,false,'El id del usuario no tiene el formato correcto');

        $this->repository->assign(
            $_idCliente,
            $_idPerfil,
            $_idModulo,
            $_menu,
            $_idUsuario
        );
    }
}
