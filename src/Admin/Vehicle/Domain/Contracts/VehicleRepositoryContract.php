<?php


namespace Src\Admin\Vehicle\Domain\Contracts;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdBrand;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdCategory;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdClass;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdFleet;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdModel;
use Src\Admin\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleUnit;
use Src\Admin\Vehicle\Domain\Vehicle;

interface VehicleRepositoryContract
{
    public function create(
        VehicleId $id,
        VehiclePlate $plate,
        VehicleUnit $unit,
        ClientId $idClient,
        VehicleIdCategory $idCategory,
        VehicleIdBrand $idBrand,
        VehicleIdModel $idModel,
        VehicleIdClass $idClass,
        VehicleIdFleet $idFleet ): ?Vehicle;
    public function update(
        VehicleId $id,
        VehiclePlate $plate,
        VehicleUnit $unit,
        VehicleIdCategory $idCategory,
        VehicleIdBrand $idBrand,
        VehicleIdModel $idModel,
        VehicleIdClass $idClass,
        VehicleIdFleet $idFleet
    ): ?Vehicle;
    public function find(
        VehicleId $id
    ): ?Vehicle;
    public function trash( VehicleId $id ): void;
    public function delete( VehicleId $id ): void;
    public function restore( VehicleId $id ): void;
    public function collectionByClient(ClientId $idClient): array;
    public function collectionActivedByClient(ClientId $idClient): array;
}
