<?php


namespace Src\Admin\VehicleModel\Domain\Contracts;


use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelId;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelName;
use Src\Admin\VehicleModel\Domain\VehicleModel;

interface VehicleModelRepositoryContract
{
    public function find( VehicleModelId $id ): ?VehicleModel;

    public function create( VehicleModelId $id, VehicleModelName $name, VehicleBrandId $idBrand ): ?VehicleModel;

    public function update( VehicleModelId $id, VehicleModelName $name, VehicleBrandId $idBrand ): ?VehicleModel;

    public function trash( VehicleModelId $id ): void;

    public function delete( VehicleModelId $id ): void;

    public function restore( VehicleModelId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;

    public function collectionByBrand( VehicleBrandId $idBrand ): array;
}
