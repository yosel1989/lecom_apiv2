<?php

declare(strict_types=1);

namespace Src\V2\LogBoletoInterprovincial\Infrastructure\Repositories;

use App\Models\V2\LogBoletoInterprovincial as EloquentModelLogBoletoInterprovincial;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\LogBoletoInterprovincial\Domain\Contracts\LogBoletoInterprovincialRepositoryContract;
use Src\V2\LogBoletoInterprovincial\Domain\LogBoletoInterprovincial;
use Src\V2\LogBoletoInterprovincial\Domain\LogBoletoInterprovincialList;

final class EloquentLogBoletoInterprovincialRepository implements LogBoletoInterprovincialRepositoryContract
{
    private EloquentModelLogBoletoInterprovincial $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelLogBoletoInterprovincial = new EloquentModelLogBoletoInterprovincial;
    }


    public function collectionByCliente(Id $idCliente, DateFormat $fecha): LogBoletoInterprovincialList
    {
        $models = $this->eloquentModelLogBoletoInterprovincial
            ->where('id_cliente',$idCliente->value())
            ->whereDate('created_at', $fecha->value())
            ->orderBy('created_at', 'DESC')->get();

        $arrVehicles = new LogBoletoInterprovincialList();

        foreach ( $models as $model ){

            $OModel = new LogBoletoInterprovincial(
                new NumericInteger($model->id),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new Text($model->motivo, false, -1, ''),
                new Text($model->descripcion, false, -1, ''),
                new DateTimeFormat($model->created_at, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            );

            $arrVehicles->add($OModel);
        }

        return $arrVehicles;
    }

}
