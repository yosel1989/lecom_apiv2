<?php

declare(strict_types=1);

namespace Src\Admin\GpsModel\Infrastructure\Repositories;

use App\Models\Admin\GpsModel as EloquentGpsModelModel;
use Src\Admin\GpsModel\Domain\Contracts\GpsModelRepositoryContract;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelDeleted;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelId;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelInput;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelName;
use Src\Admin\GpsModel\Domain\GpsModel;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelOutput;

final class EloquentGpsModelRepository implements GpsModelRepositoryContract
{
    /**
     * @var EloquentGpsModelModel
     */
    private $EloquentGpsModelModel;

    public function __construct()
    {
        $this->EloquentGpsModelModel = new EloquentGpsModelModel;
    }

    public function find(GpsModelId $id): ?GpsModel
    {
        $gpsModel = $this->EloquentGpsModelModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new GpsModel(
            new GpsModelId( $gpsModel->id ),
            new GpsModelName( $gpsModel->name ),
            new GpsModelInput( $gpsModel->number_input ),
            new GpsModelOutput( $gpsModel->number_output ),
            new GpsModelDeleted( $gpsModel->deleted )
        );

    }

    public function create( GpsModelId $id, GpsModelName $name, GpsModelInput $input, GpsModelOutput $output ): ?GpsModel
    {
        $GpsModel = $this->EloquentGpsModelModel->create([
            'id'    => $id->value(),
            'name'  => $name->value(),
            'number_input'  => $input->value(),
            'number_output'  => $output->value()
        ]);

        return new GpsModel(
            new GpsModelId( $GpsModel->id ),
            new GpsModelName( $GpsModel->name ),
            new GpsModelInput( $GpsModel->number_input ),
            new GpsModelOutput( $GpsModel->number_output ),
            new GpsModelDeleted(0)
        );
    }

    public function update( GpsModelId $id, GpsModelName $name, GpsModelInput $input, GpsModelOutput $output ): ?GpsModel
    {
        $GpsModel = tap( $this->EloquentGpsModelModel->findOrFail($id->value()) )->update([
            'name'  => $name->value(),
            'number_input'  => $input->value(),
            'number_output'  => $output->value()
        ]);

        return new GpsModel(
            new GpsModelId( $GpsModel->id ),
            new GpsModelName( $GpsModel->name ),
            new GpsModelInput( $GpsModel->number_input ),
            new GpsModelOutput( $GpsModel->number_output ),
            new GpsModelDeleted(0)
        );
    }

    public function trash( GpsModelId $id ): void
    {
        $this->EloquentGpsModelModel->findOrFail($id->value())->delete();
    }

    public function delete( GpsModelId $id ): void
    {
        $this->EloquentGpsModelModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( GpsModelId $id ): void
    {
        $this->EloquentGpsModelModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $gpsModels = $this->EloquentGpsModelModel->all();

        $arr = array();

        foreach ( $gpsModels as $gpsModel ){
            $arr[] = new GpsModel(
                new GpsModelId( $gpsModel->id ),
                new GpsModelName( $gpsModel->name ),
                new GpsModelInput( $gpsModel->number_input ),
                new GpsModelOutput( $gpsModel->number_output ),
                new GpsModelDeleted( $gpsModel->deleted )
            );
        }

        return $arr;
    }

    public function collectionTrashed(): array
    {
        $gpsModels = $this->EloquentGpsModelModel->onlyTrashed()->get();

        $arr = array();

        foreach ( $gpsModels as $gpsModel ){
            $arr[] = new GpsModel(
                new GpsModelId( $gpsModel->id ),
                new GpsModelName( $gpsModel->name ),
                new GpsModelInput( $gpsModel->number_input ),
                new GpsModelOutput( $gpsModel->number_output ),
                new GpsModelDeleted( $gpsModel->deleted )
            );
        }

        return $arr;
    }

}
