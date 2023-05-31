<?php

declare(strict_types=1);

namespace Src\Admin\OperatorPhone\Infrastructure\Repositories;

use App\Models\Admin\OperatorPhone as EloquentOperatorPhoneModel;
use Src\Admin\OperatorPhone\Domain\Contracts\OperatorPhoneRepositoryContract;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneDeleted;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneName;
use Src\Admin\OperatorPhone\Domain\OperatorPhone;

final class EloquentOperatorPhoneRepository implements OperatorPhoneRepositoryContract
{
    /**
     * @var EloquentOperatorPhoneModel
     */
    private $EloquentOperatorPhoneModel;

    public function __construct()
    {
        $this->EloquentOperatorPhoneModel = new EloquentOperatorPhoneModel;
    }

    public function find(OperatorPhoneId $id): ?OperatorPhone
    {
        $brand = $this->EloquentOperatorPhoneModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new OperatorPhone(
            new OperatorPhoneId( $brand->id ),
            new OperatorPhoneName( $brand->name ),
            new OperatorPhoneDeleted( $brand->deleted )
        );

    }

    public function create( OperatorPhoneId $id, OperatorPhoneName $name ): ?OperatorPhone
    {
        $OperatorPhone = $this->EloquentOperatorPhoneModel->create([
            'id'    => $id->value(),
            'name'  => $name->value()
        ]);

        return new OperatorPhone(
            new OperatorPhoneId( $OperatorPhone->id ),
            new OperatorPhoneName( $OperatorPhone->name ),
            new OperatorPhoneDeleted(0)
        );
    }

    public function update( OperatorPhoneId $id, OperatorPhoneName $name ): ?OperatorPhone
    {
        $OperatorPhone = tap( $this->EloquentOperatorPhoneModel->findOrFail($id->value()) )->update([
            'name'  => $name->value()
        ]);

        return new OperatorPhone(
            new OperatorPhoneId( $OperatorPhone->id ),
            new OperatorPhoneName( $OperatorPhone->name ),
            new OperatorPhoneDeleted(0)
        );
    }

    public function trash( OperatorPhoneId $id ): void
    {
        $this->EloquentOperatorPhoneModel->findOrFail($id->value())->delete();
    }

    public function delete( OperatorPhoneId $id ): void
    {
        $this->EloquentOperatorPhoneModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( OperatorPhoneId $id ): void
    {
        $this->EloquentOperatorPhoneModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $brands = $this->EloquentOperatorPhoneModel->all();

        $arrBrands = array();

        foreach ( $brands as $brand ){
            $arrBrands[] = new OperatorPhone(
                new OperatorPhoneId( $brand->id ),
                new OperatorPhoneName( $brand->name ),
                new OperatorPhoneDeleted( $brand->deleted )
            );
        }

        return $arrBrands;
    }

    public function collectionTrashed(): array
    {
        $brands = $this->EloquentOperatorPhoneModel->onlyTrashed()->get();

        $arrBrands = array();

        foreach ( $brands as $brand ){
            $arrBrands[] = new OperatorPhone(
                new OperatorPhoneId( $brand->id ),
                new OperatorPhoneName( $brand->name ),
                new OperatorPhoneDeleted( $brand->deleted )
            );
        }

        return $arrBrands;
    }

}
