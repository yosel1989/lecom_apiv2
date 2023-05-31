<?php


namespace Src\TransportePersonal\Paradero\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Paradero\Domain\Paradero;

interface ParaderoRepositoryContract
{
    public function find(Id $id): ?Paradero;

    public function create(
         Id $id,
         Text $nombre,
         Text $nombreCorto,
         Numeric $idEstado,
         Id $idUsuarioRegistro,
         Id $idCliente
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        Text $nombreCorto,
        Numeric $idEstado,
        Id $idUsuarioModifico,
        Id $idCliente
    ): void;

    public function collectionByClient(
        Id $idCliente
    ): array;

    public function listByClient(
        Id $idCliente
    ): array;

    public function assignHours(
        Id $id,
        array $hours
    ): void;

    public function listHours(
        Id $idParadero
    ): array;

    public function listHoursByRoute(
        Id $idRuta
    ): array;

}
