<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Infrastructure\Repositories;

use App\Models\User;
use App\Models\V2\BoletoInterprovincial as EloquentModelBoletoInterprovincial;
use App\Models\V2\Cliente as EloquentModelClient;
use App\Models\V2\Paradero;
use App\Models\V2\Ruta;
use App\Models\V2\TipoDocumento;
use App\Models\V2\Vehiculo;
use Src\Core\Domain\ValueObjects\DateFormat;
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
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setDynamicTableName('boleto_interprovincial_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            //->with('usuarioRegistro:id,nombres,apellidos')
//            ->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'vehiculo:id,placa', 'destino:id,nombre')
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincial(
                new Id($model->id, false, 'El id del boleto no tiene el formato correcto'),
                new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->idCliente, true, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idVehiculo, true, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->idRuta, true, 'El id de la ruta no tiene el formato correcto'),
                new Id($model->idParadero, true, 'El id del paradero no tiene el formato correcto'),
                new Id($model->idCaja, true, 'El id de la caja no tiene el formato correcto'),
                new Id($model->idPos, true, 'El id del pos no tiene el formato correcto'),
                new NumericInteger($model->idTipoDocumento->value),
                new Text($model->numeroDocumento, false, -1, ''),
                new Text($model->nombre, true, -1, ''),
                new Text($model->direccion, true, -1, ''),
                new Text($model->serie, true, -1, ''),
                new Text($model->numeroBoleto, true, -1, ''),
                new Text($model->codigoBoleto, false, -1, ''),
                new NumericFloat($model->latitud),
                new NumericFloat($model->longitud),
                new NumericFloat($model->precio),
                new DateTimeFormat($model->fecha),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new NumericInteger($model->enBlanco->value),
                new Id($model->idUsuarioRegistro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del boleto no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro),
                new DateTimeFormat($model->fechaModifico)
            );

//            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
//            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
//            $OModel->setVehiculo(new Text(!is_null($model->vehiculo) ? ( $model->vehiculo->placa . ' ' . $model->vehiculo->placa ) : null, true, -1));
//            $OModel->setDestino(new Text(!is_null($model->destino) ? ( $model->destino->nombre . ' ' . $model->destino->apellido ) : null, true, -1));


            $OModel->setUsuarioRegistro(new Text('', true, -1));
            $OModel->setUsuarioModifico(new Text('', true, -1));
            $OModel->setVehiculo(new Text('', true, -1));
//            $OModel->setDestino(new Text('', true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function reportByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): array
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
//            ->with(
//                'ruta:id,nombre'
//            )
//            ->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'vehiculo:id,placa', 'destino:id,nombre')
            ->whereDate('fecha','>=',$fechaDesde->value())
            ->whereDate('fecha','<=',$fechaHasta->value())
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincial(
                new Id($model->id, false, 'El id del boleto no tiene el formato correcto'),
                new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idVehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->idRuta, false, 'El id de la ruta no tiene el formato correcto'),
                new Id($model->idParadero, false, 'El id del paradero no tiene el formato correcto'),
                new Id($model->idCaja, false, 'El id de la caja no tiene el formato correcto'),
                new Id($model->idPos, false, 'El id del pos no tiene el formato correcto'),
                new NumericInteger($model->idTipoDocumento->value),
                new Text($model->numeroDocumento, false, -1, ''),
                new Text($model->nombre, true, -1, ''),
                new Text($model->direccion, true, -1, ''),
                new Text($model->serie, true, -1, ''),
                new Text($model->numeroBoleto, true, -1, ''),
                new Text($model->codigoBoleto, false, -1, ''),
                new NumericFloat($model->latitud),
                new NumericFloat($model->longitud),
                new NumericFloat($model->precio),
                new DateTimeFormat($model->fecha),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new NumericInteger($model->enBlanco->value),
                new Id($model->idUsuarioRegistro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del boleto no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro),
                new DateTimeFormat($model->fechaModifico)
            );

            $OModel->setUsuarioRegistro(new Text('', true, -1));
            $OModel->setUsuarioModifico(new Text('', true, -1));
            $OModel->setVehiculo(new Text('', true, -1));
            $OModel->setRuta(new Text('', true, -1));
            $OModel->setParadero(new Text('', true, -1));

            $TipoDocumento = TipoDocumento::findOrFail($model->idTipoDocumento->value);
            $OModel->setTipoDocumento(new Text($TipoDocumento->nombre, true, -1));

            if($model->idRuta){
                $Ruta = Ruta::findOrFail($model->idRuta);
                $OModel->setRuta(new Text($Ruta->nombre, true, -1));
            }

            if($model->idVehiculo){
                $Vehiculo = Vehiculo::findOrFail($model->idVehiculo);
                $OModel->setVehiculo(new Text($Vehiculo->placa, true, -1));
            }

            if($model->idParadero){
                $Paradero = Paradero::findOrFail($model->idParadero);
                $OModel->setParadero(new Text($Paradero->nombre, true, -1));
            }

            if($model->idUsuarioRegistro){
                $Usuario = User::findOrFail($model->idUsuarioRegistro);
                $OModel->setUsuarioRegistro(new Text($Usuario->nombres . ' ' . $Usuario->nombres, true, -1));
            }

            if($model->idUsuarioModifico){
                $Usuario = User::findOrFail($model->idUsuarioModifico);
                $OModel->setUsuarioModifico(new Text($Usuario->nombres . ' ' . $Usuario->nombres, true, -1));
            }

//            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
//            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
//            $OModel->setVehiculo(new Text(!is_null($model->vehiculo) ? ( $model->vehiculo->placa . ' ' . $model->vehiculo->placa ) : null, true, -1));
//            $OModel->setDestino(new Text(!is_null($model->destino) ? ( $model->destino->nombre . ' ' . $model->destino->apellido ) : null, true, -1));


            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function reportePuntoVentaByCliente(Id $idCliente, Id $idSede, DateFormat $fecha): array
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
//            ->with(
//                'ruta:id,nombre'
//            )
//            ->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'vehiculo:id,placa', 'destino:id,nombre')
            ->whereDate('fecha','=',$fecha->value())
            ->where('idSede', $idSede->value())
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincial(
                new Id($model->id, false, 'El id del boleto no tiene el formato correcto'),
                new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idVehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->idRuta, false, 'El id de la ruta no tiene el formato correcto'),
                new Id($model->idParadero, false, 'El id del paradero no tiene el formato correcto'),
                new Id($model->idCaja, false, 'El id de la caja no tiene el formato correcto'),
                new Id($model->idPos, false, 'El id del pos no tiene el formato correcto'),
                new NumericInteger($model->idTipoDocumento->value),
                new Text($model->numeroDocumento, false, -1, ''),
                new Text($model->nombre, true, -1, ''),
                new Text($model->direccion, true, -1, ''),
                new Text($model->serie, true, -1, ''),
                new Text($model->numeroBoleto, true, -1, ''),
                new Text($model->codigoBoleto, false, -1, ''),
                new NumericFloat($model->latitud),
                new NumericFloat($model->longitud),
                new NumericFloat($model->precio),
                new DateTimeFormat($model->fecha),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new NumericInteger($model->enBlanco->value),
                new Id($model->idUsuarioRegistro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del boleto no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro),
                new DateTimeFormat($model->fechaModifico)
            );

            $OModel->setUsuarioRegistro(new Text('', true, -1));
            $OModel->setUsuarioModifico(new Text('', true, -1));
            $OModel->setVehiculo(new Text('', true, -1));
            $OModel->setRuta(new Text('', true, -1));
            $OModel->setParadero(new Text('', true, -1));

            $TipoDocumento = TipoDocumento::findOrFail($model->idTipoDocumento->value);
            $OModel->setTipoDocumento(new Text($TipoDocumento->nombre, true, -1));

            if($model->idRuta){
                $Ruta = Ruta::findOrFail($model->idRuta);
                $OModel->setRuta(new Text($Ruta->nombre, true, -1));
            }

            if($model->idVehiculo){
                $Vehiculo = Vehiculo::findOrFail($model->idVehiculo);
                $OModel->setVehiculo(new Text($Vehiculo->placa, true, -1));
            }

            if($model->idParadero){
                $Paradero = Paradero::findOrFail($model->idParadero);
                $OModel->setParadero(new Text($Paradero->nombre, true, -1));
            }

            if($model->idUsuarioRegistro){
                $Usuario = User::findOrFail($model->idUsuarioRegistro);
                $OModel->setUsuarioRegistro(new Text($Usuario->nombres . ' ' . $Usuario->nombres, true, -1));
            }

            if($model->idUsuarioModifico){
                $Usuario = User::findOrFail($model->idUsuarioModifico);
                $OModel->setUsuarioModifico(new Text($Usuario->nombres . ' ' . $Usuario->nombres, true, -1));
            }

//            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
//            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
//            $OModel->setVehiculo(new Text(!is_null($model->vehiculo) ? ( $model->vehiculo->placa . ' ' . $model->vehiculo->placa ) : null, true, -1));
//            $OModel->setDestino(new Text(!is_null($model->destino) ? ( $model->destino->nombre . ' ' . $model->destino->apellido ) : null, true, -1));


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
        $model = $this->eloquentModelBoletoInterprovincial->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'vehiculo:id,placa', 'destino:id,nombre')->findOrFail($idBoletoInterprovincial->value());
        $OModel = new BoletoInterprovincial(
            new Id($model->id, false, 'El id del boleto no tiene el formato correcto'),
            new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->idVehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
            new Id($model->idRuta, false, 'El id de la ruta no tiene el formato correcto'),
            new Id($model->idParadero, false, 'El id del paradero no tiene el formato correcto'),
            new Id($model->idCaja, false, 'El id de la caja no tiene el formato correcto'),
            new Id($model->idPos, false, 'El id del pos no tiene el formato correcto'),
            new NumericInteger($model->idTipoDocumento->value),
            new Text($model->numeroDocumento, false, -1, ''),
            new Text($model->nombre, true, -1, ''),
            new Text($model->direccion, true, -1, ''),
            new Text($model->serie, true, -1, ''),
            new Text($model->numeroBoleto, true, -1, ''),
            new Text($model->codigoBoleto, false, -1, ''),
            new NumericFloat($model->latitud),
            new NumericFloat($model->longitud),
            new NumericFloat($model->precio),
            new DateTimeFormat($model->fecha),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new NumericInteger($model->enBlanco->value),
            new Id($model->idUsuarioRegistro, false, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del boleto no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro),
            new DateTimeFormat($model->fechaModifico)
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setVehiculo(new Text(!is_null($model->vehiculo) ? ( $model->vehiculo->placa . ' ' . $model->vehiculo->placa ) : null, true, -1));
//        $OModel->setDestino(new Text(!is_null($model->destino) ? ( $model->destino->nombre . ' ' . $model->destino->apellido ) : null, true, -1));


        return $OModel;
    }

}
