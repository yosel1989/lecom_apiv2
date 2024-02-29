<?php

declare(strict_types=1);

namespace Src\V2\MedioPago\Infrastructure\Repositories;

use App\Models\V2\MedioPago as EloquentModelMedioPago;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\MedioPago\Domain\Contracts\MedioPagoRepositoryContract;
use Src\V2\MedioPago\Domain\MedioPagoShort;
use Src\V2\MedioPago\Domain\MedioPagoShortList;

final class EloquentMedioPagoRepository implements MedioPagoRepositoryContract
{
    private EloquentModelMedioPago $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelMedioPago;
    }


    public function collectionToDespacho(): MedioPagoShortList
    {
        $models = $this->eloquent->select(
            'id',
            'nombre',
            'bl_entidad_financiera'
        )->where('bl_despacho', true)
            ->orderBy('nombre', 'asc')
            ->get();

        $collection = new MedioPagoShortList();

        foreach ( $models as $model ){

            $OModel = new MedioPagoShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new ValueBoolean($model->bl_entidad_financiera),
            );

            $collection->add($OModel);
        }

        return $collection;
    }

}
