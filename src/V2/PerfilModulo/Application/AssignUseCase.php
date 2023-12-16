<?php

namespace Src\V2\PerfilModulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\PerfilModulo\Domain\Contracts\PerfilModuloRepositoryContract;

final class AssignUseCase
{
    /**
     * @var PerfilModuloRepositoryContract
     */
    private PerfilModuloRepositoryContract $repository;

    public function __construct( PerfilModuloRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idPerfil,
        array $modulos,
        string $idUsuario
    ): void
    {
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idPerfil = new Id($idPerfil,false,'El id del perfil no tiene el formato correcto');
        $_modulos = $modulos;
        $_idUsuario = new Id($idUsuario,false,'El id del usuario no tiene el formato correcto');

        $this->repository->assign(
            $_idCliente,
            $_idPerfil,
            $_modulos,
            $_idUsuario
        );

    }
}
