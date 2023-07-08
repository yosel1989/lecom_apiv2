<?php

namespace Src\V2\Perfil\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Perfil\Domain\Contracts\PerfilRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var PerfilRepositoryContract
     */
    private PerfilRepositoryContract $repository;

    public function __construct( PerfilRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idPerfil,
        string $nombre,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idPerfil = new Id($idPerfil,false,'El id del perfil no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del perfil excede los 100 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idPerfil,
            $_nombre,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
