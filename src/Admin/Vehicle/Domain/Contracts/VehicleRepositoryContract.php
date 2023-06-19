<?php


namespace Src\Admin\Vehicle\Domain\Contracts;

use Src\Admin\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleUnit;
use Src\Admin\Vehicle\Domain\Vehicle;
use Src\Core\Domain\ValueObjects\Id;

interface VehicleRepositoryContract
{
    public function create(
        Id $id,
        VehiclePlate $placa,
        VehicleUnit $unidad,
        Id $idCliente,
        Id $idCategoria,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota ): ?Vehicle;
    public function update(
        Id $id,
        VehiclePlate $placa,
        VehicleUnit $unidad,
        Id $idCategoria,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota
    ): ?Vehicle;
    public function find(
        Id $idVehiculo
    ): ?Vehicle;
    public function trash( Id $idVehiculo ): void;
    public function delete( Id $idVehiculo ): void;
    public function restore( Id $idVehiculo ): void;
    public function collectionByClient(Id $idCliente): array;
    public function collectionActivedByClient(Id $idCliente): array;
}
