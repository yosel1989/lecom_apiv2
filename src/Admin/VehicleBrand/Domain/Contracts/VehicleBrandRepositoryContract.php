<?php


namespace Src\Admin\VehicleBrand\Domain\Contracts;


use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandName;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;

interface VehicleBrandRepositoryContract
{
    public function find( VehicleBrandId $id ): ?VehicleBrand;

    public function create( VehicleBrandId $id, VehicleBrandName $name ): ?VehicleBrand;

    public function update( VehicleBrandId $id, VehicleBrandName $name ): ?VehicleBrand;

    public function trash( VehicleBrandId $id ): void;

    public function delete( VehicleBrandId $id ): void;

    public function restore( VehicleBrandId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;
}
