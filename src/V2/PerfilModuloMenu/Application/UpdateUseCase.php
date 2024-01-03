<?php

namespace Src\V2\PerfilModuloMenu\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\PerfilModuloMenu\Domain\Contracts\PerfilModuloMenuRepositoryContract;

final class UpdateUseCase
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
        string $idPerfilModuloMenu,
        string $nombre,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idPerfilModuloMenu = new Id($idPerfilModuloMenu,false,'El id del perfil no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del perfil excede los 100 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idPerfilModuloMenu,
            $_nombre,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
