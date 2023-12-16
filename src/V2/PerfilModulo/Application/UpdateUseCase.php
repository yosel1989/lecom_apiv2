<?php

namespace Src\V2\PerfilModulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\PerfilModulo\Domain\Contracts\PerfilModuloRepositoryContract;

final class UpdateUseCase
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
        string $idPerfilModulo,
        string $nombre,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idPerfilModulo = new Id($idPerfilModulo,false,'El id del perfil no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del perfil excede los 100 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idPerfilModulo,
            $_nombre,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
