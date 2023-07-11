<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Infrastructure\Repositories;

use App\Models\V2\BoletoInterprovincial as EloquentModelBoletoInterprovincial;
use App\Models\Admin\Client as EloquentModelClient;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincial;

final class EloquentBoletoInterprovincialRepository implements BoletoInterprovincialRepositoryContract
{
    private EloquentModelBoletoInterprovincial $eloquentModelBoletoInterprovincial;
    private EloquentModelClient $eloquentClientModel;

    public function __construct()
    {
        $this->eloquentModelBoletoInterprovincial = new EloquentModelBoletoInterprovincial;
        $this->eloquentClientModel = new EloquentModelClient;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $OCliente = $this->eloquentClientModel->where('id', $idCliente->value())->get();

//        throw new \InvalidArgumentException((string)($OCliente->first()->codigo));
//        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_' . $OCliente->first()->codigo );

        $models = $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_' . $OCliente->first()->codigo)->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincial(
                new Id($model->id, false, 'El id del boleto no tiene el formato correcto'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idVehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->idDestino, false, 'El id del destino no tiene el formato correcto'),
                new Text($model->numeroDocumento, false, -1, ''),
                new Text($model->codigoBoleto, false, -1, ''),
                new NumericFloat($model->latitud),
                new NumericFloat($model->longitud),
                new NumericFloat($model->precio),
                new DateTimeFormat($model->fecha),
                new NumericInteger($model->idEstado),
                new NumericInteger($model->idEliminado),
                new Id($model->idUsurioRegistro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del boleto no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro),
                new DateTimeFormat($model->fechaModifico)
            );

            $OModel->setUsuarioRegistro(new Text(""));
            $OModel->setUsuarioModifico(new Text(""));
            $OModel->setVehiculo(new Text(""));
            $OModel->setDestino(new Text(""));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }



    public function changeState(
        Id $idBoletoInterprovincial,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelBoletoInterprovincial->findOrFail($idBoletoInterprovincial->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idBoletoInterprovincial,
    ): BoletoInterprovincial
    {
        $model = $this->eloquentModelBoletoInterprovincial->findOrFail($idBoletoInterprovincial->value());
        $OModel = new BoletoInterprovincial(
            new Id($model->id, false, 'El id del boleto no tiene el formato correcto'),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->idVehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
            new Id($model->idDestino, false, 'El id del destino no tiene el formato correcto'),
            new Text($model->numeroDocumento, false, -1, ''),
            new Text($model->codigoBoleto, false, -1, ''),
            new NumericFloat($model->latitud),
            new NumericFloat($model->longitud),
            new NumericFloat($model->precio),
            new DateTimeFormat($model->fecha),
            new NumericInteger($model->idEstado),
            new NumericInteger($model->idEliminado),
            new Id($model->idUsurioRegistro, false, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del boleto no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro),
            new DateTimeFormat($model->fechaModifico)
        );
        $OModel->setUsuarioRegistro(new Text(""));
        $OModel->setUsuarioModifico(new Text(""));
        $OModel->setVehiculo(new Text(""));
        $OModel->setDestino(new Text(""));


        return $OModel;
    }

}
