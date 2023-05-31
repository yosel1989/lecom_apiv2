<?php

namespace Src\Administracion\TipoEgreso\Domain\Contracts;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\TipoEgreso\Domain\TipoEgreso;

interface TipoEgresoRepositoryContract
{
    public function find(Id $id): ?TipoEgreso;

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
