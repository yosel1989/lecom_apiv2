<?php


namespace Src\TransportePersonal\Ruta\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Ruta\Domain\Ruta;
use Src\TransportePersonal\Ruta\Domain\RutaVehiculo;

interface RutaRepositoryContract
{
    public function find(Id $id): ?Ruta;

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
        Id $idRuta
    ): array;

    public function collectionByClient(
        Id $idCliente
    ): array;

    public function assignVehicles(
        Id $id,
        array $vehiculos
    ): void;

    public function listVehicles(
        Id $idRuta
    ): array;

    public function findVehicleByPlate(
        Text $placa
    ): ?RutaVehiculo;

}
