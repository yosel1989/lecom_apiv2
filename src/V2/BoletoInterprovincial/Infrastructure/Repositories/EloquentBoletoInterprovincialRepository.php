<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Infrastructure\Repositories;

use App\Enums\EnumTipoComprobante;
use App\Enums\IdTipoBoleto;
use App\Enums\IdTipoSerie;
use App\Models\User;
use App\Models\V2\BoletoInterprovincialOficial as EloquentModelBoletoInterprovincial;
use App\Models\V2\Caja;
use App\Models\V2\Cliente as EloquentModelClient;
use App\Models\V2\Paradero;
use App\Models\V2\Ruta;
use App\Models\V2\Sede;
use App\Models\V2\TipoDocumento;
use App\Models\V2\Vehiculo;
use InvalidArgumentException;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\TimeFormat;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
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
        $this->eloquentModelBoletoInterprovincial->setDynamicTableName('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            //->with('usuarioRegistro:id,nombres,apellidos')
//            ->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'vehiculo:id,placa', 'destino:id,nombre')
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincialOficial(
                new Id($model->id, false, 'El id del boleto no tiene el formato correcto'),
                new Id($model->id_cliente, true, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->id_caja, true, 'El id de la caja no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_documento->value),
                new Text($model->numero_documento, false, -1, ''),
                new Text($model->nombres, false, -1, ''),
                new Text($model->apellidos, false, -1, ''),
                new NumericInteger($model->menor_edad),
                new Id($model->id_vehiculo, true, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->id_asiento, true, 'El id del asiento no tiene el formato correcto'),
                new DateFormat($model->f_partida, true, 'La fecha de partida no tiene el formato correcto'),
                new TimeFormat($model->h_partida, true, 'La hora de partida no tiene el formato correcto'),
                new Id($model->id_ruta, true, 'El id de la ruta no tiene el formato correcto'),
                new Id($model->id_paradero_origen, true, 'El id del paradero origen no tiene el formato correcto'),
                new Id($model->id_paradero_destino, true, 'El id del paradero destino no tiene el formato correcto'),
                new NumericFloat($model->precio),
                new NumericInteger($model->id_tipo_moneda),
                new NumericInteger($model->id_forma_pago),
                new NumericInteger($model->obsequio),
                new NumericInteger($model->id_tipo_comprobante),
                new NumericInteger($model->id_tipo_documento_entidad),
                new Text($model->numero_documento_entidad, false, -1),
                new Text($model->nombre_entidad, false, -1, ''),
                new Text($model->direccion_entidad, true, -1, ''),
                new Id($model->id_usu_registro, false, 'El id del usuario no tiene el formato correcto'),
            );

//            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
//            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
//            $OModel->setVehiculo(new Text(!is_null($model->vehiculo) ? ( $model->vehiculo->placa . ' ' . $model->vehiculo->placa ) : null, true, -1));
//            $OModel->setDestino(new Text(!is_null($model->destino) ? ( $model->destino->nombre . ' ' . $model->destino->apellido ) : null, true, -1));


            $OModel->setUsuarioRegistro(new Text('', true, -1));
            $OModel->setUsuarioModifico(new Text('', true, -1));
//            $OModel->setVehiculo(new Text('', true, -1));
//            $OModel->setDestino(new Text('', true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function reportByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): array
    {

        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
//            ->with(
//                'ruta:id,nombre'
//            )
//            ->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'vehiculo:id,placa', 'destino:id,nombre')
            ->whereDate('f_registro','>=',$fechaDesde->value())
            ->whereDate('f_registro','<=',$fechaHasta->value())
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincialOficial(
                new Id($model->id, false, 'El id del boleto no tiene el formato correcto'),
                new Id($model->id_cliente, true, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->id_caja, true, 'El id de la caja no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_documento->value),
                new Text($model->numero_documento, false, -1, ''),
                new Text($model->nombres, false, -1, ''),
                new Text($model->apellidos, false, -1, ''),
                new NumericInteger((int)$model->menor_edad),
                new Id($model->id_vehiculo, true, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->id_asiento, true, 'El id del asiento no tiene el formato correcto'),
                new DateFormat($model->f_partida, true, 'La fecha de partida no tiene el formato correcto'),
                new TimeFormat($model->h_partida, true, 'La hora de partida no tiene el formato correcto'),
                new Id($model->id_ruta, true, 'El id de la ruta no tiene el formato correcto'),
                new Id($model->id_paradero_origen, true, 'El id del paradero origen no tiene el formato correcto'),
                new Id($model->id_paradero_destino, true, 'El id del paradero destino no tiene el formato correcto'),
                new NumericFloat($model->precio),
                new NumericInteger($model->id_tipo_moneda->value),
                new NumericInteger($model->id_forma_pago->value),
                new NumericInteger((int)$model->obsequio),
                new Id($model->id_pos, true, 'El id del pos no tiene el formato correcto'),
                new Text($model->codigo, false, -1),
                new NumericFloat($model->latitud),
                new NumericFloat($model->longitud),
                new DateTimeFormat($model->f_emision),
                new NumericInteger($model->idEstado),
                new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro),
                new DateTimeFormat($model->f_modifico),
                new NumericInteger($model->id_tipo_comprobante->value),
                new NumericInteger($model->id_tipo_boleto->value),
                new NumericInteger((int)$model->por_pagar),
            );

            $TipoDocumento = $model->id_tipo_documento ? TipoDocumento::findOrFail($model->id_tipo_documento->value, ['nombre_corto']) : null;
            $OModel->setTipoDocumento(new Text(($TipoDocumento?->nombre_corto), true, -1));

            $Sede = $model->id_sede ? Sede::findOrFail($model->id_sede, ['nombre']) : null;
            $OModel->setSede(new Text(($Sede?->nombre), true, -1));

            $Caja = $model->id_caja ? Caja::findOrFail($model->id_caja, ['nombre']) : null;
            $OModel->setCaja(new Text(($Caja?->nombre), true, -1));

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
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_vehiculo, true, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->id_ruta, true, 'El id de la ruta no tiene el formato correcto'),
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

            if($model->id_ruta){
                $Ruta = Ruta::findOrFail($model->id_ruta);
                $OModel->setRuta(new Text($Ruta->nombre, true, -1));
            }

            if($model->id_vehiculo){
                $Vehiculo = Vehiculo::findOrFail($model->id_vehiculo);
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
            new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_vehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
            new Id($model->id_ruta, false, 'El id de la ruta no tiene el formato correcto'),
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

    ): BoletoInterprovincialOficial
    {
        // Validar caja
        $Caja = Caja::selectRaw('count(*) as total')->where('id', $_idCaja->value())->where('idEstado', 1)->where('idEliminado',0)->first();
        if( $Caja->total === 0 ){
            throw new InvalidArgumentException( 'La caja no se encuentra registrado en el sistema o esta inhabilitado.' );
        }
        // Validar cliente
        $Cliente = \App\Models\V2\Cliente::selectRaw('count(*) as total')->where('id', $_idCliente->value())->where('idEstado',1)->where('idEliminado',0)->first();
        if( $Cliente->total === 0 ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }
        // validar ruta
        $Ruta = \App\Models\V2\Ruta::selectRaw('count(*) as total')->where('id', $_idRuta->value())->where('idEstado',1)->where('idEliminado',0)->where('idCliente',$_idCliente->value())->first();
        if( $Ruta->total === 0 ){
            throw new InvalidArgumentException( 'La ruta no se encuentra registrado en el sistema o esta inhabilitado.' );
        }
        // validar paradero
        $Paradero = \App\Models\V2\Paradero::selectRaw('count(*) as total')->where('id', $_idParadero->value())->where('idEstado',1)->where('idEliminado',0)->where('idCliente',$_idCliente->value())->first();
        if( $Paradero->total === 0 ) {
            throw new InvalidArgumentException('El paradero no se encuentra registrado en el sistema o esta inhabilitado.');
        }


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

//        $total = $model->selectRaw('COUNT(*) as total')->where('serie', $_serie->nombre)->where('idSede',$_serie->id_sede)->get()->first()->total;
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

            'idTipoComprobante' => $_idTipoComprobante->value(),
//            'idTipoDocumentoEntidad' => $_idTipoDocumentoEntidad->value(),
//            'numeroDocumentoEntidad' => $_numeroDocumentoEntidad->value(),
//            'nombreEntidad' => $_nombreEntidad->value(),
//            'direccionEntidad' => $_direccionEntidad->value(),

            'fechaEmision' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
            'idUsuarioRegistro' => $_idUsuarioRegistro->value(),

            'idTipoBoleto' => IdTipoBoleto::VentaBoleto->value

        ]);


        $boleto = $model->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'vehiculo:id,placa',
            'ruta:id,nombre',
            'paradero:id,nombre',
            'tipoDocumento:id,nombre',
            'caja:id,nombre',
            'sede:id,nombre',
            'tipoMoneda:id,nombre',
            'tipoComprobante:id,nombre',
            'tipoDocumentoEntidad:id,nombre',
        )->findOrFail($_id->value());
        $OUTPUT = new BoletoInterprovincialOficial(
             new Id($boleto->id,false, 'El id no tiene el formato correcto'),

             new Id($boleto->id_cliente,false, 'El id del cliente no tiene el formato correcto'),
             new Id($boleto->id_sede,false, 'El id de la sede no tiene el formato correcto'),
             new Id($boleto->idCaja,false, 'El id de la caja no tiene el formato correcto'),
             new NumericInteger($boleto->idTipoDocumento->value),
             new Text($boleto->numeroDocumento,false, -1, ''),
             new Text($boleto->nombres,false, -1, ''),
             new Text($boleto->apellidos,false, -1, ''),
             new NumericInteger((int)$boleto->menorEdad),


             new Id($boleto->id_vehiculo,true, 'El id del vehiculo no tiene el formato correcto'),
             new Id($boleto->idAsiento,true, 'El id del asiento no tiene el formato correcto'),
             new DateFormat($boleto->fechaPartida,true, 'El formato de la fecha no es la correcta'),
             new DateFormat($boleto->horaPartida,true, 'El formato de la hora no es la correcta'),
             new Id($boleto->id_ruta,false, 'El id de la ruta no tiene el formato correcto'),
             new Id($boleto->idParadero,false, 'El id del paradero no tiene el formato correcto'),
             new NumericFloat($boleto->precio),
             new NumericInteger($boleto->idTipoMoneda->value),
             new NumericInteger($boleto->idFormaPago->value),
             new NumericInteger((int)$boleto->obsequio),

             new NumericInteger($boleto->idTipoComprobante->value),
             new NumericInteger($boleto->idTipoDocumentoEntidad),
             new Text($boleto->numeroDocumentoEntidad,true, -1, ''),
             new Text($boleto->nombreEntidad,true, -1, ''),
             new Text($boleto->direccionEntidad,true, -1, ''),

             new Id($boleto->idUsuarioRegistro,false, 'El id del usuario no tiene el formato correcto')
        );
        $OUTPUT->setVehiculoPlaca(new Text(!is_null($boleto->vehiculo) ? $boleto->vehiculo->placa : null, true, -1));
        $OUTPUT->setRuta(new Text(!is_null($boleto->ruta) ? $boleto->ruta->nombre : null, true, -1));
        $OUTPUT->setParadero(new Text(!is_null($boleto->paradero) ? $boleto->paradero->nombre : null, true, -1));
        $OUTPUT->setTipoDocumento(new Text(!is_null($boleto->tipoDocumento) ? $boleto->tipoDocumento->nombre : null, true, -1));
        $OUTPUT->setCaja(new Text(!is_null($boleto->caja) ? $boleto->caja->nombre : null, true, -1));
        $OUTPUT->setTipoComprobante(new Text(!is_null($boleto->tipoComprobante) ? $boleto->tipoComprobante->nombre : null, true, -1));

        return $OUTPUT;
    }

}
