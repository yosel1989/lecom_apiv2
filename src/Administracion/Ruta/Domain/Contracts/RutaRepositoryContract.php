<?php

namespace Src\Administracion\Ruta\Domain\Contracts;

use Src\Administracion\Ruta\Domain\RutaShort;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Ruta\Domain\Ruta;

interface RutaRepositoryContract
{
    public function find(Id $id): ?Ruta;

    public function create(
         Id $id,
         Text $nombre,
         Text $codigo,
         Numeric $idEstado,
         Id $idUsuarioRegistro,
         Id $idCliente
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        Text $codigo,
        Numeric $idEstado,
        Id $idUsuarioModifico,
        Id $idCliente
    ): void;


    public function collectionByClient(
        Id $idCliente
    ): array;

    public function collectionActivedByClient(
        Id $idCliente
    ): array;

    public function findByClientByCode(
        Id $idCliente,
        Text $codigoRuta
    ): ?RutaShort;

}
