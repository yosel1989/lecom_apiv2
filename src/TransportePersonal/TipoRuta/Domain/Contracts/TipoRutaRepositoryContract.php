<?php


namespace Src\TransportePersonal\TipoRuta\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\TipoRuta\Domain\TipoRuta;

interface TipoRutaRepositoryContract
{
    public function find(Id $id): ?TipoRuta;

    public function create(
         Id $id,
         Text $nombre,
         Numeric $idEstado,
         Id $idUsuarioRegistro,
         Id $idCliente
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        Numeric $idEstado,
        Id $idUsuarioModifico,
        Id $idCliente
    ): void;

    public function assignPoints(
        Id $id,
        array $paraderos
    ): void;

    public function listPoints(
        Id $idTipoRuta
    ): array;

    public function collectionByClient(
        Id $idCliente
    ): array;

}
