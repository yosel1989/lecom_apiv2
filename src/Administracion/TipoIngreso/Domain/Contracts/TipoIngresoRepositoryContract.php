<?php

namespace Src\Administracion\TipoIngreso\Domain\Contracts;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\TipoIngreso\Domain\TipoIngreso;

interface TipoIngresoRepositoryContract
{
    public function find(Id $id): ?TipoIngreso;

    public function create(
        Id $id,
        Text $nombre,
        Text $descripcion,
        Numeric $registraVehiculo,
        Numeric $registraPersonal,
        Numeric $registraRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        Text $descripcion,
        Numeric $registraVehiculo,
        Numeric $registraPersonal,
        Numeric $registraRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function collectionByClient(Id $idCliente): array;
    public function listByClient(Id $idCliente): array;

}
