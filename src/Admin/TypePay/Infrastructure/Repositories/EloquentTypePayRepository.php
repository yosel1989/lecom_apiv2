<?php

declare(strict_types=1);

namespace Src\Admin\TypePay\Infrastructure\Repositories;

use App\Models\Admin\TypePay as EloquentTypePayModel;
use Src\Admin\TypePay\Domain\Contracts\TypePayRepositoryContract;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayAmount;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayCurrency;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayDeleted;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayDescription;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayId;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayName;
use Src\Admin\TypePay\Domain\TypePay;

final class EloquentTypePayRepository implements TypePayRepositoryContract
{
    /**
     * @var EloquentTypePayModel
     */
    private $EloquentTypePayModel;

    public function __construct()
    {
        $this->EloquentTypePayModel = new EloquentTypePayModel;
    }

    public function find(TypePayId $id): ?TypePay
    {
        $typePay = $this->EloquentTypePayModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new TypePay(
            new TypePayId( $typePay->id ),
            new TypePayName( $typePay->name ),
            new TypePayDescription( $typePay->description ),
            new TypePayCurrency( $typePay->currency ),
            new TypePayAmount( $typePay->amount ),
            new TypePayDeleted( $typePay->deleted )
        );

    }

    public function create(
        TypePayId $id,
        TypePayName $name,
        TypePayDescription $description,
        TypePayCurrency $currency,
        TypePayAmount $amount
    ): ?TypePay
    {
        $this->EloquentTypePayModel->create([
            'id'    => $id->value(),
            'name'  => $name->value(),
            'description'  => $description->value(),
            'currency'  => $currency->value(),
            'amount'  => $amount->value()
        ]);

        $TypePay = $this->EloquentTypePayModel->findOrFail($id->value());

        return new TypePay(
            new TypePayId( $TypePay->id ),
            new TypePayName( $TypePay->name ),
            new TypePayDescription( $TypePay->description ),
            new TypePayCurrency( $TypePay->currency ),
            new TypePayAmount( $TypePay->amount ),
            new TypePayDeleted( $TypePay->deleted )
        );
    }

    public function update(
        TypePayId $id,
        TypePayName $name,
        TypePayDescription $description,
        TypePayCurrency $currency,
        TypePayAmount $amount
    ): ?TypePay
    {
        $TypePay = tap( $this->EloquentTypePayModel->findOrFail($id->value()) )->update([
            'name'  => $name->value(),
            'description'  => $description->value(),
            'currency'  => $currency->value(),
            'amount'  => $amount->value()
        ]);

        return new TypePay(
            new TypePayId( $TypePay->id ),
            new TypePayName( $TypePay->name ),
            new TypePayDescription( $TypePay->description ),
            new TypePayCurrency( $TypePay->currency ),
            new TypePayAmount( $TypePay->amount ),
            new TypePayDeleted( $TypePay->deleted )
        );
    }

    public function trash( TypePayId $id ): void
    {
        $this->EloquentTypePayModel->findOrFail($id->value())->delete();
    }

    public function delete( TypePayId $id ): void
    {
        $this->EloquentTypePayModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( TypePayId $id ): void
    {
        $this->EloquentTypePayModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $types = $this->EloquentTypePayModel->all();

        $collection = array();

        foreach ( $types as $type ){
            $collection[] = new TypePay(
                new TypePayId( $type->id ),
                new TypePayName( $type->name ),
                new TypePayDescription( $type->description ),
                new TypePayCurrency( $type->currency ),
                new TypePayAmount( $type->amount ),
                new TypePayDeleted( $type->deleted )
            );
        }

        return $collection;
    }

    public function collectionTrashed(): array
    {
        $types = $this->EloquentTypePayModel->onlyTrashed()->get();

        $collection = array();

        foreach ( $types as $type ){
            $collection[] = new TypePay(
                new TypePayId( $type->id ),
                new TypePayName( $type->name ),
                new TypePayDescription( $type->description ),
                new TypePayCurrency( $type->currency ),
                new TypePayAmount( $type->amount ),
                new TypePayDeleted( $type->deleted )
            );
        }

        return $collection;
    }

}
