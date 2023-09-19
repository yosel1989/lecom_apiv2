<?php

declare(strict_types=1);

namespace Src\V2\TipoPago\Infrastructure\Repositories;

use App\Models\V2\TipoPago as EloquentModelTipoPago;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\TipoPago\Domain\Contracts\TipoPagoRepositoryContract;
use Src\V2\TipoPago\Domain\TipoPago;

final class EloquentTipoPagoRepository implements TipoPagoRepositoryContract
{
    private EloquentModelTipoPago $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelTipoPago = new EloquentModelTipoPago;
    }


    public function list(): array
    {
        $models = $this->eloquentModelTipoPago->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new TipoPago(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new Text($model->valor, false, -1, '')
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


}
