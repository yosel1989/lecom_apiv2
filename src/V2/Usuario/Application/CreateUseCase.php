<?php

namespace Src\V2\Usuario\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Usuario\Domain\Contracts\UsuarioRepositoryContract;

final class CreateUseCase
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
        string $usuario,
        string $clave,
        string $nombre,
        string $apellido,
        ?string $correo,
        ?string $idPersonal,
        ?string $idPerfil,
        ?string $idSede,
        string $idCliente,
        int $idNivelUsuario,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_usuario = new Text($usuario,true, 20,'El nombre de usuario excede los 20 caracteres');
        $_clave = new Text($clave,false, 15,'La contraseña excede los 15 caracteres');
        $_nombre = new Text($nombre,false, 100,'El nombre excede los 100 caracteres');
        $_apellido = new Text($apellido,false, 100,'El apellido excede los 100 caracteres');
        $_correo = new Text($correo,true, 100,'El correo excede los 100 caracteres');
        $_idPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato correcto');
        $_idPerfil = new Id($idPerfil,true,'El id del perfil no tiene el formato correcto');
        $_idSede = new Id($idSede,true,'El id de la sede no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idNivelUsuario = new NumericInteger($idNivelUsuario);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario que registra no tiene el formato correcto');

        $this->repository->create(
            $_usuario,
            $_clave,
            $_nombre,
            $_apellido,
            $_idPersonal,
            $_idPerfil,
            $_idSede,
            $_correo,
            $_idCliente,
            $_idNivelUsuario,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
