<?php

namespace Src\V2\Usuario\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Usuario\Domain\Contracts\UsuarioRepositoryContract;

final class UpdateUseCase
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
        string $nombre,
        string $apellido,
        ?string $correo,
        ?string $idPersonal,
        ?string $idPerfil,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idUsuario = new Id($idUsuario,true, 'El id del usuario no tiene el formato correcto');
        $_nombre = new Text($nombre,false, 100,'El nombre excede los 100 caracteres');
        $_apellido = new Text($apellido,false, 100,'El apellido excede los 100 caracteres');
        $_correo = new Text($correo,true, 100,'El correo excede los 100 caracteres');
        $_idPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato correcto');
        $_idPerfil = new Id($idPerfil,true,'El id del perfil no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario que modifica no tiene el formato correcto');

        $this->repository->update(
            $_idUsuario,
            $_nombre,
            $_apellido,
            $_idPersonal,
            $_idPerfil,
            $_correo,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
