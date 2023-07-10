<?php

namespace Src\V2\Personal\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Personal\Domain\Personal;

interface PersonalRepositoryContract
{
    public function create(
        Text $foto,
        Text $nombre,
        Text $apellido,
        Id $idTipoDocumento,
        Text $numeroDocumento,
        Text $correo,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;
    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;

    public function update(
        Id $idPersonal,
        Text $foto,
        Text $nombre,
        Text $apellido,
        Id $idTipoDocumento,
        Text $numeroDocumento,
        Text $correo,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idPersonal,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idPersonal,
    ): Personal;
}
