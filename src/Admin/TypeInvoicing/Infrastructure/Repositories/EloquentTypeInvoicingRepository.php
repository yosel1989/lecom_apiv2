<?php

declare(strict_types=1);

namespace Src\Admin\TypeInvoicing\Infrastructure\Repositories;

use App\Models\Admin\TypeInvoicing as EloquentTypeInvoicingModel;
use Src\Admin\TypeInvoicing\Domain\Contracts\TypeInvoicingRepositoryContract;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingDeleted;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingId;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingMounths;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingName;
use Src\Admin\TypeInvoicing\Domain\TypeInvoicing;

final class EloquentTypeInvoicingRepository implements TypeInvoicingRepositoryContract
{
    /**
     * @var EloquentTypeInvoicingModel
     */
    private $EloquentTypeInvoicingModel;

    public function __construct()
    {
        $this->EloquentTypeInvoicingModel = new EloquentTypeInvoicingModel;
    }

    public function find(TypeInvoicingId $id): ?TypeInvoicing
    {
        $gpsModel = $this->EloquentTypeInvoicingModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new TypeInvoicing(
            new TypeInvoicingId( $gpsModel->id ),
            new TypeInvoicingName( $gpsModel->name ),
            new TypeInvoicingMounths( $gpsModel->months ),
            new TypeInvoicingDeleted( $gpsModel->deleted )
        );

    }

    public function create( TypeInvoicingId $id, TypeInvoicingName $name, TypeInvoicingMounths $mounths ): ?TypeInvoicing
    {
        $this->EloquentTypeInvoicingModel->create([
            'id'    => $id->value(),
            'name'  => $name->value(),
            'months'  => $mounths->value()
        ]);

        $TypeInvoicing = $this->EloquentTypeInvoicingModel->findOrFail($id->value());

        return new TypeInvoicing(
            new TypeInvoicingId( $TypeInvoicing->id ),
            new TypeInvoicingName( $TypeInvoicing->name ),
            new TypeInvoicingMounths( $TypeInvoicing->months ),
            new TypeInvoicingDeleted( $TypeInvoicing->deleted )
        );
    }

    public function update( TypeInvoicingId $id, TypeInvoicingName $name, TypeInvoicingMounths $mounths ): ?TypeInvoicing
    {
        $TypeInvoicing = tap( $this->EloquentTypeInvoicingModel->findOrFail($id->value()) )->update([
            'name'  => $name->value(),
            'months'  => $mounths->value()
        ]);

        return new TypeInvoicing(
            new TypeInvoicingId( $TypeInvoicing->id ),
            new TypeInvoicingName( $TypeInvoicing->name ),
            new TypeInvoicingMounths( $TypeInvoicing->months ),
            new TypeInvoicingDeleted( $TypeInvoicing->deleted )
        );
    }

    public function trash( TypeInvoicingId $id ): void
    {
        $this->EloquentTypeInvoicingModel->findOrFail($id->value())->delete();
    }

    public function delete( TypeInvoicingId $id ): void
    {
        $this->EloquentTypeInvoicingModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( TypeInvoicingId $id ): void
    {
        $this->EloquentTypeInvoicingModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $types = $this->EloquentTypeInvoicingModel->all();

        $collection = array();

        foreach ( $types as $type ){
            $collection[] = new TypeInvoicing(
                new TypeInvoicingId( $type->id ),
                new TypeInvoicingName( $type->name ),
                new TypeInvoicingMounths( $type->months ),
                new TypeInvoicingDeleted( $type->deleted )
            );
        }

        return $collection;
    }

    public function collectionTrashed(): array
    {
        $types = $this->EloquentTypeInvoicingModel->onlyTrashed()->get();

        $collection = array();

        foreach ( $types as $type ){
            $collection[] = new TypeInvoicing(
                new TypeInvoicingId( $type->id ),
                new TypeInvoicingName( $type->name ),
                new TypeInvoicingMounths( $type->months ),
                new TypeInvoicingDeleted( $type->deleted )
            );
        }

        return $collection;
    }

}
