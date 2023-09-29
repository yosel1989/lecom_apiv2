<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Infrastructure\Repositories;

use App\Enums\EnumTipoComprobante;
use App\Enums\IdTipoBoleto;
use App\Enums\IdTipoSerie;
use App\Models\User;
use App\Models\V2\BoletoInterprovincial as EloquentModelBoletoInterprovincial;
use App\Models\V2\Cliente as EloquentModelClient;
use App\Models\V2\Paradero;
use App\Models\V2\Ruta;
use App\Models\V2\TipoDocumento;
use App\Models\V2\Vehiculo;
use InvalidArgumentException;
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
        set_time_limit(240);


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
                new Text($model->serieComprobante, true, -1, ''),
                new Text($model->numeroComprobante, true, -1, ''),
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

    public function puntoVenta(
        Id $_id,

        Id $_idCliente,
        Id $_idSede,
        Id $_idCaja,
        NumericInteger $_idTipoDocumento,
        Text $_numeroDocumento,
        Text $_nombres,
        Text $_apellidos,
        NumericInteger $_menorEdad,

        Id $_idVehiculo,
        Id $_idAsiento,
        DateFormat $_fechaPartida,
        DateFormat $_horaPartida,
        Id $_idRuta,
        Id $_idParadero,
        NumericFloat $_precio,
        NumericInteger $_idTipoMoneda,
        NumericInteger $_idFormaPago,
        NumericInteger $_obsequio,

        NumericInteger $_idTipoComprobante,
        NumericInteger $_idTipoDocumentoEntidad,
        Text $_numeroDocumentoEntidad,
        Text $_nombreEntidad,
        Text $_direccionEntidad,

        Id $_idUsuarioRegistro
    ): void
    {
        $Cliente = \App\Models\V2\Cliente::where('id', $_idCliente->value())->where('idEstado',1)->where('idEliminado',0)->get();
        if( $Cliente->isEmpty() ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }
        $Ruta = \App\Models\V2\Ruta::where('id', $_idRuta->value())
            ->where('idEstado',1)
            ->where('idEliminado',0)
            ->where('idCliente',$_idCliente->value())
            ->get();
        if( $Ruta->isEmpty() ){
            throw new InvalidArgumentException( 'La ruta no se encuentra registrado en el sistema o esta inhabilitado.' );
        }
        $Paradero = \App\Models\V2\Paradero::where('id', $_idParadero->value())
            ->where('idEstado',1)
            ->where('idEliminado',0)
            ->where('idCliente',$_idCliente->value())
            ->get();
        if( $Paradero->isEmpty() ) {
            throw new InvalidArgumentException('El paradero no se encuentra registrado en el sistema o esta inhabilitado.');
        }
        $Caja  = \App\Models\V2\Caja::
            where('idEstado',1)
            ->where('idEliminado',0)
            ->where('idCliente',$_idCliente->value())
            ->where('idSede', $_idSede->value())
            ->get();
        if( $Caja->isEmpty() ){
            throw new InvalidArgumentException('La caja no se encuentra registrado en el sistema o esta inhabilitado.');
        }
        $_caja = $Caja->first();

        $Serie  = \App\Models\V2\ComprobanteSerie::
        where('idEstado',1)
//            ->where('idEliminado',0)
            ->where('idCliente',$_idCliente->value())
            ->where('idSede', $_idSede->value())
            ->where('idTipoComprobante', $_idTipoComprobante->value())
            ->get();
        if( $Serie->isEmpty() ){
            throw new InvalidArgumentException('Falta configurar la serie en el sistema');
        }
        $_serie = $Serie->first();


        $model = new \App\Models\V2\BoletoInterprovincial();
//        $model->setTable('boleto_interprovincial_' . $Cliente->first()->codigo);

//        $total = $model->selectRaw('COUNT(*) as total')->where('serie', $_serie->nombre)->where('idSede',$_serie->idSede)->get()->first()->total;
//

        $model->create([
            'id' => $_id->value(),

            'idCliente' => $_idCliente->value(),
            'idSede' => $_idSede->value(),
            'idCaja' => $_idCaja->value(),
            'idTipoDocumento' => $_idTipoDocumento->value(),
            'numeroDocumento' => $_numeroDocumento->value(),
            'nombres' => $_nombres->value(),
            'apellidos' => $_apellidos->value(),
            'menorEdad' => $_menorEdad->value(),

            'idVehiculo' => $_idVehiculo->value(),
            'idAsiento' => $_idAsiento->value(),
            'fechaPartida' => $_fechaPartida->value(),
            'horaPartida' => $_horaPartida->value(),
            'idRuta' => $_idRuta->value(),
            'idParadero' => $_idParadero->value(),
            'precio' => $_precio->value(),
            'idTipoMoneda' => $_idTipoMoneda->value(),
            'idFormaPago' => $_idFormaPago->value(),
            'obsequio' => $_obsequio->value(),

            'codigo' => 'B' . $Cliente->first()->codigo .'-'.(new \DateTime('now'))->format('YmdHis'),
            'latitud' => 0,
            'longitud' => 0,

//            'idTipoComprobante' => $_idTipoComprobante->value(),
//            'idTipoDocumentoEntidad' => $_idTipoDocumentoEntidad->value(),
//            'numeroDocumentoEntidad' => $_numeroDocumentoEntidad->value(),
//            'nombreEntidad' => $_nombreEntidad->value(),
//            'direccionEntidad' => $_direccionEntidad->value(),

            'fechaEmision' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
            'idUsuarioRegistro' => $_idUsuarioRegistro->value(),

            'idTipoBoleto' => IdTipoBoleto::VentaBoleto->value

        ]);
    }

}
