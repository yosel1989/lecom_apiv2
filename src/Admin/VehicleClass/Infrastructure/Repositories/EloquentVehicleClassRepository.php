<?php

declare(strict_types=1);

namespace Src\Admin\VehicleClass\Infrastructure\Repositories;

use App\Models\General\VehicleClass as EloquentVehicleClassModel;
use Src\Admin\VehicleClass\Domain\Contracts\VehicleClassRepositoryContract;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassDeleted;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassIcon;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassId;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassName;
use Src\Admin\VehicleClass\Domain\VehicleClass;

final class EloquentVehicleClassRepository implements VehicleClassRepositoryContract
{
    /**
     * @var EloquentVehicleClassModel
     */
    private $EloquentVehicleClassModel;

    public function __construct()
    {
        $this->EloquentVehicleClassModel = new EloquentVehicleClassModel;
    }

    public function find(VehicleClassId $id): ?VehicleClass
    {
        $model = $this->EloquentVehicleClassModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new VehicleClass(
            new VehicleClassId( $model->id ),
            new VehicleClassName( $model->name ),
            new VehicleClassIcon( $model->icon ),
            new VehicleClassDeleted( $model->deleted )
        );

    }

    public function create( VehicleClassId $id, VehicleClassName $name, VehicleClassIcon $icon ): ?VehicleClass
    {
        $this->EloquentVehicleClassModel->create([
            'id'    => $id->value(),
            'name'  => $name->value(),
            'icon'  => $icon->value()
        ]);

        $VehicleClass = $this->EloquentVehicleClassModel->findOrFail($id->value());

        $OVehicleClass = new VehicleClass(
            new VehicleClassId( $VehicleClass->id ),
            new VehicleClassName( $VehicleClass->name ),
            new VehicleClassIcon( $VehicleClass->icon ),
            new VehicleClassDeleted(0)
        );

        return $OVehicleClass;
    }

    public function update( VehicleClassId $id, VehicleClassName $name, VehicleClassIcon $icon ): ?VehicleClass
    {
        $this->EloquentVehicleClassModel->findOrFail($id->value())->update([
            'name'  => $name->value(),
            'icon' => $icon->value()
        ]);

        $VehicleClass = $this->EloquentVehicleClassModel->findOrFail($id->value());

        $OVehicleClass = new VehicleClass(
            new VehicleClassId( $VehicleClass->id ),
            new VehicleClassName( $VehicleClass->name ),
            new VehicleClassIcon( $VehicleClass->icon ),
            new VehicleClassDeleted(0)
        );

        return $OVehicleClass;
    }

    public function trash( VehicleClassId $id ): void
    {
        $this->EloquentVehicleClassModel->findOrFail($id->value())->delete();
    }

    public function delete( VehicleClassId $id ): void
    {
        $this->EloquentVehicleClassModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( VehicleClassId $id ): void
    {
        $this->EloquentVehicleClassModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $models = $this->EloquentVehicleClassModel->all();

        $arrBrands = array();

        foreach ( $models as $model ){
            $OVehicleClass = new VehicleClass(
                new VehicleClassId( $model->id ),
                new VehicleClassName( $model->name ),
                new VehicleClassIcon( $model->icon ),
                new VehicleClassDeleted( $model->deleted )
            );

            $arrBrands[] = $OVehicleClass;
        }

        return $arrBrands;
    }

    public function collectionTrashed(): array
    {
        $models = $this->EloquentVehicleClassModel->onlyTrashed()->get();

        $arrBrands = array();

        foreach ( $models as $model ){
            $OVehicleClass = new VehicleClass(
                new VehicleClassId( $model->id ),
                new VehicleClassName( $model->name ),
                new VehicleClassIcon( $model->icon ),
                new VehicleClassDeleted( $model->deleted )
            );

            $arrBrands[] = $OVehicleClass;
        }

        return $arrBrands;
    }

}
