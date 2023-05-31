<?php


namespace Src\Admin\VehicleClass\Domain\Contracts;


use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassIcon;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassId;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassName;
use Src\Admin\VehicleClass\Domain\VehicleClass;

interface VehicleClassRepositoryContract
{
    public function find( VehicleClassId $id ): ?VehicleClass;

    public function create( VehicleClassId $id, VehicleClassName $name, VehicleClassIcon $icon ): ?VehicleClass;

    public function update( VehicleClassId $id, VehicleClassName $name, VehicleClassIcon $icon ): ?VehicleClass;

    public function trash( VehicleClassId $id ): void;

    public function delete( VehicleClassId $id ): void;

    public function restore( VehicleClassId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;
}
