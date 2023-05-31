<?php


namespace Src\TransportePersonal\Troncal\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Troncal\Domain\Troncal;

interface TroncalRepositoryContract
{
    public function find(Id $id): ?Troncal;

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
        Id $idTroncal
    ): array;

    public function collectionByClient(
        Id $idCliente
    ): array;

}
