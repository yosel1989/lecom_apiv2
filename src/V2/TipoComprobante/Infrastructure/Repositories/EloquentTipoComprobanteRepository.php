<?php

declare(strict_types=1);

namespace Src\V2\TipoComprobante\Infrastructure\Repositories;

use App\Models\V2\TipoComprobante as EloquentModelTipoComprobante;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\TipoComprobante\Domain\Contracts\TipoComprobanteRepositoryContract;
use Src\V2\TipoComprobante\Domain\TipoComprobante;

final class EloquentTipoComprobanteRepository implements TipoComprobanteRepositoryContract
{
    private EloquentModelTipoComprobante $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelTipoComprobante;
    }


    public function list(): array
    {
        $models = $this->eloquent->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new TipoComprobante(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new NumericInteger($model->bl_punto_venta->value),
                new ValueBoolean($model->bl_despacho),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listPuntoVenta(): array
    {
        $models = $this->eloquent->where('bl_punto_venta', 1)->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new TipoComprobante(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new NumericInteger($model->bl_punto_venta->value),
                new ValueBoolean($model->bl_despacho),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listDespacho(): array
    {
        $models = $this->eloquent->where('bl_despacho', 1)->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new TipoComprobante(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new NumericInteger($model->bl_punto_venta->value),
                new ValueBoolean($model->bl_despacho),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }
}
