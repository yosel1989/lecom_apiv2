<?php

namespace Src\V2\Usuario\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Usuario\Domain\Usuario;

interface UsuarioRepositoryContract
{
    public function create(
        Text $usuario,
        Text $clave,
        Text $nombre,
        Text $apellido,
        Id $idPersonal,
        Id $idPerfil,
        Text $correo,
        Id $idCliente,
        NumericInteger $idNivelUsuario,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;
    public function collectionByCliente(Id $idCliente): array;

    public function update(
        Id $idUsuario,
        Text $nombre,
        Text $apellido,
        Id $idPersonal,
        Id $idPerfil,
        Text $correo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idUsuario,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function changePassword(
        Id $idUsuario,
        Text $clave,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idUsuario,
    ): Usuario;
}
