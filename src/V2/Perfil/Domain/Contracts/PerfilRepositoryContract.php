<?php

namespace Src\V2\Perfil\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Perfil\Domain\Perfil;

interface PerfilRepositoryContract
{
    public function create(
        Text $nombre,
        NumericInteger $idNivelUsuario,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): array;
    public function collectionByClienteByNivel(Id $idCliente, NumericInteger $idNivelUsuario): array;
    public function listByCliente(Id $idCliente): array;
    public function listByClienteByNivel(Id $idCliente, NumericInteger $idNivelUsuario): array;

    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idPerfil,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idPerfil,
    ): Perfil;
}
