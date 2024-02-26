<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Infrastructure\Repositories;

use App\Enums\EnumAcciones;
use App\Enums\EnumEstadoBoletoInterprovincial;
use App\Enums\EnumOrigenBoleto;
use App\Enums\IdTipoBoleto;
use App\Models\User;
use App\Models\V2\CajaDiario;
use App\Models\V2\Cliente as EloquentModelClient;
use App\Models\V2\HistorialBoletoInterprovincial as EloquentModelHistorialBoletoInterprovincial;
use App\Models\V2\BoletoInterprovincialOficial as EloquentModelBoletoInterprovincial;
use App\Models\V2\Caja;
use App\Models\V2\Cliente;
use App\Models\V2\ComprobanteSerie;
use App\Models\V2\Paradero;
use App\Models\V2\Ruta;
use App\Models\V2\Sede;
use App\Models\V2\TipoComprobante;
use App\Models\V2\TipoDocumento;
use App\Models\V2\UsuarioVehiculo;
use App\Models\V2\Vehiculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\TimeFormat;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialLiquidacionVehiculoFecha;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialPasajero;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialShortFecha;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialShortFechaList;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialVehiculo;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialVehiculoRangoFecha;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;
use Src\V2\Vehiculo\Domain\VehiculoShortList;

final class EloquentBoletoInterprovincialRepository implements BoletoInterprovincialRepositoryContract
{
    private EloquentModelBoletoInterprovincial $eloquentModelBoletoInterprovincial;
    private EloquentModelClient $eloquentClientModel;
    private EloquentModelHistorialBoletoInterprovincial $eloquentModelHistorialBoletoInterprovincial;

    public function __construct()
    {
        $this->eloquentModelBoletoInterprovincial = new EloquentModelBoletoInterprovincial;
        $this->eloquentClientModel = new EloquentModelClient;
        $this->eloquentModelHistorialBoletoInterprovincial = new EloquentModelHistorialBoletoInterprovincial;
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

    public function reportByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idRuta, Id $idUsuario): array
    {

        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'boleto_interprovincial_cliente_' . $OCliente->codigo .'.*',
            )
//            ->with(
//                'ruta:id,nombre'
//            )
//            ->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'vehiculo:id,placa', 'destino:id,nombre')
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo .'.f_registro','>=',$fechaDesde->value())
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo .'.f_registro','>=',$fechaDesde->value());

        if(!is_null($idRuta->value())){
            $models->where('id_ruta',$idRuta->value());
        }

        $models = $models->orderBy('f_registro', 'DESC')
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

            $Vehiculo = $model->id_vehiculo ? Vehiculo::findOrFail($model->id_vehiculo, ['placa']) : null;
            $OModel->setVehiculoPlaca(new Text(($Vehiculo?->placa), true, -1));

            $Ruta = $model->id_ruta ? Ruta::findOrFail($model->id_ruta, ['nombre']) : null;
            $OModel->setRuta(new Text(($Ruta?->nombre), true, -1));

            $TipoDocumento = $model->id_tipo_documento ? TipoDocumento::findOrFail($model->id_tipo_documento->value, ['nombre_corto']) : null;
            $OModel->setTipoDocumento(new Text(($TipoDocumento?->nombre_corto), true, -1));

            $Sede = $model->id_sede ? Sede::findOrFail($model->id_sede, ['nombre']) : null;
            $OModel->setSede(new Text(($Sede?->nombre), true, -1));

            $Caja = $model->id_caja ? Caja::findOrFail($model->id_caja, ['nombre']) : null;
            $OModel->setCaja(new Text(($Caja?->nombre), true, -1));

            $ParaderoOrigen = $model->id_paradero_origen ? Paradero::findOrFail($model->id_paradero_origen, ['nombre']) : null;
            $OModel->setParaderoOrigen(new Text(($ParaderoOrigen?->nombre), true, -1));

            $ParaderoDestino = $model->id_paradero_destino ? Paradero::findOrFail($model->id_paradero_destino, ['nombre']) : null;
            $OModel->setParaderoDestino(new Text(($ParaderoDestino?->nombre), true, -1));

            $UsuarioRegistro = $model->id_usu_registro ? User::findOrFail($model->id_usu_registro, ['nombres','apellidos']) : null;
            $OModel->setUsuarioRegistro(new Text(($UsuarioRegistro?->nombres . ' ' . $UsuarioRegistro?->apellidos), true, -1));

            $UsuarioModifico = $model->id_usu_modifico ? User::findOrFail($model->id_usu_modifico, ['nombres','apellidos']) : null;
            $OModel->setUsuarioModifico(new Text(($UsuarioModifico?->nombres . ' ' . $UsuarioModifico?->apellidos), true, -1));

            $TipoComprobante = $model->id_tipo_comprobante ? TipoComprobante::findOrFail($model->id_tipo_comprobante->value, ['nombre']) : null;
            $OModel->setTipoComprobante(new Text(($TipoComprobante?->nombre), true, -1));

            $OModel->setIdOrigen(new NumericInteger($model->id_origen));
            $OModel->setIdCajaDiario(new Id($model->id_caja_diario, true, 'El id de la caja diario no tiene un formato correcto'));
            $OModel->setIdLiquidacion(new Id($model->id_liquidacion, true, 'El id de la liquidación no tiene un formato correcto'));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }



    public function reportByUsuarioCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idRuta, VehiculoShortList $vehiculos): array
    {
        /** @var array $idVehiculos */
        $idVehiculos = array_map(function($v){
            return $v->getId()->value();
        }, $vehiculos->all());


        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'boleto_interprovincial_cliente_' . $OCliente->codigo .'.*',
                'ce_comprobante_electronico.serie as serie',
                'ce_comprobante_electronico.numero as numero',
                'tipo_comprobante.abreviatura as tipoComprobante',
                'origen_boleto.nombre as origen'
            )
            ->leftjoin('ce_comprobante_electronico',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id', '=', 'ce_comprobante_electronico.id_producto')
            ->leftjoin('origen_boleto',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_origen', '=', 'origen_boleto.id')
            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')

            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo .'.f_registro','>=',$fechaDesde->value())
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo .'.f_registro','<=',$fechaDesde->value());

        if(!is_null($idRuta->value())) $models->where('boleto_interprovincial_cliente_' . $OCliente->codigo .'.id_ruta',$idRuta->value());

        $models = $models->orderBy('boleto_interprovincial_cliente_' . $OCliente->codigo .'.f_registro', 'DESC')->get();

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

            $Vehiculo = $model->id_vehiculo ? Vehiculo::findOrFail($model->id_vehiculo, ['placa']) : null;
            $OModel->setVehiculoPlaca(new Text(($Vehiculo?->placa), true, -1));

            $Ruta = $model->id_ruta ? Ruta::findOrFail($model->id_ruta, ['nombre']) : null;
            $OModel->setRuta(new Text(($Ruta?->nombre), true, -1));

            $TipoDocumento = $model->id_tipo_documento ? TipoDocumento::findOrFail($model->id_tipo_documento->value, ['nombre_corto']) : null;
            $OModel->setTipoDocumento(new Text(($TipoDocumento?->nombre_corto), true, -1));

            $Sede = $model->id_sede ? Sede::findOrFail($model->id_sede, ['nombre']) : null;
            $OModel->setSede(new Text(($Sede?->nombre), true, -1));

            $Caja = $model->id_caja ? Caja::findOrFail($model->id_caja, ['nombre']) : null;
            $OModel->setCaja(new Text(($Caja?->nombre), true, -1));

            $ParaderoOrigen = $model->id_paradero_origen ? Paradero::findOrFail($model->id_paradero_origen, ['nombre']) : null;
            $OModel->setParaderoOrigen(new Text(($ParaderoOrigen?->nombre), true, -1));

            $ParaderoDestino = $model->id_paradero_destino ? Paradero::findOrFail($model->id_paradero_destino, ['nombre']) : null;
            $OModel->setParaderoDestino(new Text(($ParaderoDestino?->nombre), true, -1));

            $UsuarioRegistro = $model->id_usu_registro ? User::findOrFail($model->id_usu_registro, ['nombres','apellidos']) : null;
            $OModel->setUsuarioRegistro(new Text(($UsuarioRegistro?->nombres . ' ' . $UsuarioRegistro?->apellidos), true, -1));

            $UsuarioModifico = $model->id_usu_modifico ? User::findOrFail($model->id_usu_modifico, ['nombres','apellidos']) : null;
            $OModel->setUsuarioModifico(new Text(($UsuarioModifico?->nombres . ' ' . $UsuarioModifico?->apellidos), true, -1));

            $OModel->setTipoComprobante(new Text($model->tipoComprobante, true, -1 , ''));
            $OModel->setComprobanteNumero(new NumericInteger($model->numero));
            $OModel->setComprobanteSerie(new Text($model->serie, true, -1, ''));
            $OModel->setIdOrigen(new NumericInteger($model->id_origen));
            $OModel->setOrigen(new Text($model->origen, true, -1, ''));
            $OModel->setIdCajaDiario(new Id($model->id_caja_diario, true, 'El id de la caja diario no tiene un formato correcto'));
            $OModel->setIdLiquidacion(new Id($model->id_liquidacion, true, 'El id de la liquidación no tiene un formato correcto'));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function reportByClienteGroupVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idRuta, VehiculoShortList $vehiculos): array
    {
        /** @var array $idVehiculos */
        $idVehiculos = array_map(function($v){
            return $v->getId()->value();
        }, $vehiculos->all());


        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'id_vehiculo',
                DB::raw('SUM(precio) as total'),
                'placa'
            )
            ->innerJoin('vehiculos','id_vehiculo','=','vehiculos.id')
            ->whereDate('f_registro','>=',$fechaDesde->value())
            ->whereDate('f_registro','<=',$fechaDesde->value())
            ->whereIn('id_vehiculo', $idVehiculos);

        if(!is_null($idRuta->value())) $models->where('id_ruta',$idRuta->value());

        $models = $models->orderBy('f_registro', 'DESC')->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincialVehiculo(
                new Id($model->id_vehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
                new Text($model->placa, false, -1 ,''),
                new NumericFloat($model->total),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function reportePuntoVentaByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): array
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'boleto_interprovincial_cliente_' . $OCliente->codigo .'.*',
                'ce_comprobante_electronico.serie as serie',
                'ce_comprobante_electronico.numero as numero',
                'tipo_comprobante.nombre as tipoComprobante',
                'origen_boleto.nombre as origen',
                'e_boleto_interprovincial.nombre as estado'
            )
            ->leftjoin('ce_comprobante_electronico',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id', '=', 'ce_comprobante_electronico.id_producto')
            ->leftjoin('origen_boleto',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_origen', '=', 'origen_boleto.id')
            ->leftjoin('e_boleto_interprovincial',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_estado', '=', 'e_boleto_interprovincial.id')
            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo .'.f_registro','=',$fecha->value())
            ->where('boleto_interprovincial_cliente_' . $OCliente->codigo .'.id_usu_registro', $idUsuario->value())
            ->orderBy('f_registro','desc')
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

            $Vehiculo = $model->id_vehiculo ? Vehiculo::findOrFail($model->id_vehiculo, ['placa']) : null;
            $OModel->setVehiculoPlaca(new Text(($Vehiculo?->placa), true, -1));

            $Ruta = $model->id_ruta ? Ruta::findOrFail($model->id_ruta, ['nombre']) : null;
            $OModel->setRuta(new Text(($Ruta?->nombre), true, -1));

            $TipoDocumento = $model->id_tipo_documento ? TipoDocumento::findOrFail($model->id_tipo_documento->value, ['nombre_corto']) : null;
            $OModel->setTipoDocumento(new Text(($TipoDocumento?->nombre_corto), true, -1));

            $Sede = $model->id_sede ? Sede::findOrFail($model->id_sede, ['nombre']) : null;
            $OModel->setSede(new Text(($Sede?->nombre), true, -1));

            $Caja = $model->id_caja ? Caja::findOrFail($model->id_caja, ['nombre']) : null;
            $OModel->setCaja(new Text(($Caja?->nombre), true, -1));

            $ParaderoOrigen = $model->id_paradero_origen ? Paradero::findOrFail($model->id_paradero_origen, ['nombre']) : null;
            $OModel->setParaderoOrigen(new Text(($ParaderoOrigen?->nombre), true, -1));

            $ParaderoDestino = $model->id_paradero_destino ? Paradero::findOrFail($model->id_paradero_destino, ['nombre']) : null;
            $OModel->setParaderoDestino(new Text(($ParaderoDestino?->nombre), true, -1));

            $UsuarioRegistro = $model->id_usu_registro ? User::findOrFail($model->id_usu_registro, ['nombres','apellidos']) : null;
            $OModel->setUsuarioRegistro(new Text(($UsuarioRegistro?->nombres . ' ' . $UsuarioRegistro?->apellidos), true, -1));

            $UsuarioModifico = $model->id_usu_modifico ? User::findOrFail($model->id_usu_modifico, ['nombres','apellidos']) : null;
            $OModel->setUsuarioModifico(new Text(($UsuarioModifico?->nombres . ' ' . $UsuarioModifico?->apellidos), true, -1));

            $OModel->setEstado(new Text($model->estado, true, -1 , ''));
            $OModel->setTipoComprobante(new Text($model->tipoComprobante, true, -1 , ''));
            $OModel->setComprobanteNumero(new NumericInteger($model->numero));
            $OModel->setComprobanteSerie(new Text($model->serie, true, -1, ''));
            $OModel->setIdOrigen(new NumericInteger($model->id_origen));
            $OModel->setOrigen(new Text($model->origen, true, -1, ''));
            $OModel->setIdCajaDiario(new Id($model->id_caja_diario, true, 'El id de la caja diario no tiene un formato correcto'));
            $OModel->setIdLiquidacion(new Id($model->id_liquidacion, true, 'El id de la liquidación no tiene un formato correcto'));


            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function changeState(
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioModifico,
    ): void
    {

//        $this->eloquentModelBoletoInterprovincial->findOrFail($idBoletoInterprovincial->value())->update([
//           'idEstado' => $idEstado->value(),
//           'idUsuarioModifico' => $idUsuarioModifico->value()
//        ]);
    }

    public function scanById(
        Id $idCliente,
        Id $idVehiculo,
        Id $idBoletoInterprovincial,
        Id $idUsuario
    ): void
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $boleto = $this->eloquentModelBoletoInterprovincial->where('id', $idBoletoInterprovincial->value());
        if($boleto->count() == 0){
            throw new \InvalidArgumentException('El boleto no se encuentra registrado');
        }

        if(!is_null($boleto->first()->id_vehiculo)){
            throw new \InvalidArgumentException('El boleto ya fue escaneado');
        }

        if($boleto->first()->id_estado == 2){
            throw new \InvalidArgumentException('El boleto fue anulado');
        }

        $boleto->first()->update([
            'id_vehiculo' => $idVehiculo->value(),
            'id_usu_modifico' => $idUsuario->value(),
            'f_partida' => (new \DateTime('now'))->format('Y-m-d'),
            'h_partida' => (new \DateTime('now'))->format('H:i:s'),
        ]);

        $this->eloquentModelHistorialBoletoInterprovincial->create([
            'id_boleto' => $boleto->first()->id,
            'id_cliente' => $boleto->first()->id_cliente,
            'id_accion' => EnumAcciones::BoletoEscaneado->value,
            'descripcion' => '',
            'id_usu_registro' => $idUsuario->value(),
            'f_registro' => (new \DateTime('now'))->format('Y-m-d H:i:s')
        ]);
    }


    public function traslateById(
        Id $idCliente,
        Id $idVehiculo,
        Id $idBoletoInterprovincial,
        Id $idUsuario,
        NumericInteger $idMotivo
    ): void
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $boleto = $this->eloquentModelBoletoInterprovincial->where('id', $idBoletoInterprovincial->value());
        if($boleto->count() == 0){
            throw new \InvalidArgumentException('El boleto no se encuentra registrado');
        }

        if(is_null($boleto->first()->id_vehiculo)){
            throw new \InvalidArgumentException('El boleto no fue escaneado', 400);
        }

        if($boleto->first()->id_estado == 2){
            throw new \InvalidArgumentException('El boleto fue anulado');
        }

        if($boleto->first()->id_cliente !== $idCliente){
            throw new \InvalidArgumentException('No se puede escanear el boleto de otro cliente');
        }

        $_oldVehiculo = Vehiculo::findOrFail($boleto->first()->id_vehiculo);
        $_currentVehiculo = Vehiculo::findOrFail($idVehiculo->value());

        $boleto->first()->update([
            'id_vehiculo' => $idVehiculo->value(),
            'id_usu_modifico' => $idUsuario->value()
        ]);

        $this->eloquentModelHistorialBoletoInterprovincial->create([
            'id_boleto' => $boleto->first()->id,
            'id_cliente' => $boleto->first()->id_cliente,
            'id_accion' => EnumAcciones::TraspasoBoleto->value,
            'descripcion' => 'De ' . $_oldVehiculo->placa . ' a ' . $_currentVehiculo->placa,
            'id_usu_registro' => $idUsuario->value(),
            'f_registro' => (new \DateTime('now'))->format('Y-m-d H:i:s')
        ]);
    }

    public function find(
        Id $idBoletoInterprovincial,
        Id $idCliente
    ): BoletoInterprovincialOficial
    {

        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);


        $model = $this->eloquentModelBoletoInterprovincial
            ->select(
                'boleto_interprovincial_cliente_' . $OCliente->codigo.'.*',
                'users.nombres as nombres',
                'users.apellidos as apellidos',
                'ce_comprobante_electronico.serie as serie',
                'ce_comprobante_electronico.numero as numero',
                'tipo_comprobante.nombre as tipoComprobante',
                'rutas.nombre as ruta',
                'po.nombre as paraderoOrigen',
                'pd.nombre as paraderoDestino',
                'caja.nombre as caja',
                'clientes.nombre as cliente',
            )
            ->leftJoin('users','boleto_interprovincial_cliente_' . $OCliente->codigo.'.id_usu_registro', 'users.id')
            ->leftjoin('ce_comprobante_electronico',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id', '=', 'ce_comprobante_electronico.id_producto')
            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->leftjoin('rutas',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_ruta', '=', 'rutas.id')
            ->leftjoin('paradero as po',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_paradero_origen', '=', 'po.id')
            ->leftjoin('paradero as pd',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_paradero_destino', '=', 'pd.id')
            ->leftjoin('caja',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_caja', '=', 'caja.id')
            ->leftjoin('clientes',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_cliente', '=', 'clientes.id')
//            ->leftjoin('tipo_documento',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_tipo_documento', '=', 'caja.id')
            ->findOrFail($idBoletoInterprovincial->value());
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
        $OModel->setUsuarioRegistro(new Text(( $model->nombres . ' ' . substr($model->apellidos, 0, 2).'***' ) , true, -1));
        $OModel->setTipoComprobante(new Text($model->tipoComprobante, true, -1 , ''));
        $OModel->setComprobanteNumero(new NumericInteger($model->numero));
        $OModel->setComprobanteSerie(new Text($model->serie, true, -1, ''));
        $OModel->setRuta(new Text($model->ruta, true, -1, ''));
        $OModel->setParaderoOrigen(new Text($model->paraderoOrigen, true, -1, ''));
        $OModel->setParaderoDestino(new Text($model->paraderoDestino, true, -1, ''));
        $OModel->setCaja(new Text($model->caja, true, -1, ''));
        $OModel->setCliente(new Text($model->cliente, true, -1, ''));
//        $OModel->setTipoDocumento(new Text($model->tipoDocumento, true, -1, ''));
//        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
//        $OModel->setVehiculo(new Text(!is_null($model->vehiculo) ? ( $model->vehiculo->placa . ' ' . $model->vehiculo->placa ) : null, true, -1));
//        $OModel->setDestino(new Text(!is_null($model->destino) ? ( $model->destino->nombre . ' ' . $model->destino->apellido ) : null, true, -1));


        return $OModel;
    }

    public function puntoVenta(

        Id $_id,

        Id $_idCliente,
        Id $_idSede,
        Id $_idCaja,
        Id $_idCajaDiario,
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
        Id $_idBoletoPrecio,
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
        // Validar sede
        $Sede = Sede::where('id', $_idSede->value())->where('id_estado', 1)->where('id_eliminado',0)->where('id_cliente',$_idCliente->value());
        if( $Sede->count() === 0 ){
            throw new InvalidArgumentException( 'La sede no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        if( is_null($Sede->first()->codigo) ){
            throw new InvalidArgumentException( 'Falta ingresar el código de la sede' );
        }

        // Validar sede
        $Serie = ComprobanteSerie::where('id_estado', 1)->where('id_cliente',$_idCliente->value())->where('id_tipo_comprobante',$_idTipoComprobante->value());
        if( $Serie->count() === 0 ){
            throw new InvalidArgumentException( 'Falta registrar la serie en el sistema' );
        }
        if( $Serie->count() > 1 ){
            throw new InvalidArgumentException( 'Existe más de una serie registrada' );
        }
        // Validar caja
        $Caja = Caja::selectRaw('count(*) as total')->where('id', $_idCaja->value())->where('id_estado', 1)->where('id_eliminado',0)->first();
        if( $Caja->total === 0 ){
            throw new InvalidArgumentException( 'La caja no se encuentra registrado en el sistema o esta inhabilitado.' );
        }
        // Validar caja diario
        $CajaDiario = CajaDiario::selectRaw('count(*) as total')->where('id', $_idCajaDiario->value())->where('id_estado', 1)->where('id_eliminado',0)->whereNull('f_cierre')->first();
        if( $CajaDiario->total === 0 ){
            throw new InvalidArgumentException( 'La caja no se encuentra aperturada' );
        }
        // Validar cliente
        $Cliente = \App\Models\V2\Cliente::where('id', $_idCliente->value())->where('idEstado',1)->where('idEliminado',0);
        if( $Cliente->count() === 0 ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }
        // validar ruta
        $Ruta = \App\Models\V2\Ruta::selectRaw('count(*) as total')->where('id', $_idRuta->value())->where('id_estado',1)->where('id_eliminado',0)->where('id_cliente',$_idCliente->value())->first();
        if( $Ruta->total === 0 ){
            throw new InvalidArgumentException( 'La ruta no se encuentra registrado en el sistema o esta inhabilitado.' );
        }
        $_ruta = Ruta::findOrFail($_idRuta->value(), ['nombre']);
        // validar viaje
        $BoletoPrecio = \App\Models\V2\BoletoPrecio::selectRaw('count(*) as total')->where('id', $_idBoletoPrecio->value())->where('id_estado',1)->where('id_eliminado',0)->where('id_cliente',$_idCliente->value())->where('id_ruta',$_idRuta->value())->first();
        if( $BoletoPrecio->total === 0 ) {
            throw new InvalidArgumentException('El viaje no se encuentra registrado en el sistema o esta inhabilitado.');
        }
        $viaje = \App\Models\V2\BoletoPrecio::findOrFail($_idBoletoPrecio->value(), ['id','id_paradero_origen','id_paradero_destino']);
        $ParaderoDestino = Paradero::findOrFail($viaje->id_paradero_destino, ['nombre']) ;


        $Serie  = \App\Models\V2\ComprobanteSerie::
        where('id_estado',1)
//            ->where('idEliminado',0)
            ->where('id_cliente',$_idCliente->value())
            ->where('id_sede', $_idSede->value())
            ->where('id_tipo_comprobante', $_idTipoComprobante->value())
            ->get();

        if( $Serie->isEmpty() ){
            throw new InvalidArgumentException('Falta configurar la serie en el sistema');
        }
        $_serie = $Serie->first();


        $model = new \App\Models\V2\BoletoInterprovincialOficial();
        $model->setTable('boleto_interprovincial_cliente_' . $Cliente->first()->codigo);
        $model->setDynamicTableName('boleto_interprovincial_cliente_' . $Cliente->first()->codigo);

//        $total = $model->selectRaw('COUNT(*) as total')->where('serie', $_serie->nombre)->where('idSede',$_serie->id_sede)->get()->first()->total;
//
        $idBoleto = Uuid::uuid4();
        $idComprobanteElectronico = Uuid::uuid4();

        $user = Auth::user();

        // Número de boleto
        $numeroBoleto = $model->where('id_cliente', $Cliente->first()->id)
                              ->whereDate('f_registro',  (new \DateTime('now'))->format('Y-m-d'))
                              ->count();

        $model->create([
            'id' => $idBoleto,
            'id_ruta' => $_idRuta->value(),
            'id_paradero_origen' => $viaje->id_paradero_origen,
            'id_paradero_destino' => $viaje->id_paradero_destino,
            'id_vehiculo' => $_idVehiculo->value(),
            'id_caja' => $_idCaja->value(),
            'id_caja_diario' => $_idCajaDiario->value(),
            'id_pos' => null,
            'id_cliente' => $_idCliente->value(),

            // boleto
            'codigo' => "B" . str_pad($Sede->first()->codigo,5,'0',STR_PAD_LEFT)  . (new \DateTime('now'))->format('Ymd') . str_pad((string)($numeroBoleto+1),5,'0',STR_PAD_LEFT),
            'latitud' => 0,
            'longitud' => 0,
            'precio' => $_precio->value(),
            'f_partida' => $_fechaPartida->value(),
            'h_partida' => $_horaPartida->value(),
            'id_usu_registro' => $user->getId(),
            'id_sede' => $_idSede->value(),

            //pasajero
            'id_tipo_documento' => $_idTipoDocumento->value(),
            'numero_documento' => $_numeroDocumento->value(),
            'nombres' => $_nombres->value(),
            'apellidos' => $_apellidos->value(),
            'nombre' => $_nombres->value() . ' ' . $_apellidos->value(),

            // estados
//          'enBlanco' => 0,
            'anulado' => 0,

//          // comprobante
            'id_tipo_comprobante' => $_idTipoComprobante->value(),
//            'serieComprobante' => $_serie->nombre,
//            'numeroComprobante' => 111111111,

            'por_pagar' => 0,
            'id_tipo_boleto' => IdTipoBoleto::VentaBoleto->value,

            'menor_edad' => $_menorEdad->value(),

            'id_tipo_moneda' => $_idTipoMoneda->value(),
            'id_forma_pago' => $_idFormaPago->value(),
            'obsequio' => $_obsequio->value(),
            'f_emision' => (new \DateTime('now'))->format('Y-m-d H:m:s'),
            'id_estado' => 1,
            'id_origen' => EnumOrigenBoleto::COUNTER->value
        ]);

        $boleto = $model->find($idBoleto);
//        throw new InvalidArgumentException(var_dump($boleto));
        $OUTPUT = new BoletoInterprovincialOficial(
            new Id($boleto->id, false, 'El id del boleto no tiene el formato correcto'),
            new Id($boleto->id_cliente, true, 'El id del cliente no tiene el formato correcto'),
            new Id($boleto->id_sede, true, 'El id de la sede no tiene el formato correcto'),
            new Id($boleto->id_caja, true, 'El id de la caja no tiene el formato correcto'),
            new NumericInteger($boleto->id_tipo_documento->value),
            new Text($boleto->numero_documento, false, -1, ''),
            new Text($boleto->nombres, false, -1, ''),
            new Text($boleto->apellidos, false, -1, ''),
            new NumericInteger((int)$boleto->menor_edad),
            new Id($boleto->id_vehiculo, true, 'El id del vehiculo no tiene el formato correcto'),
            new Id($boleto->id_asiento, true, 'El id del asiento no tiene el formato correcto'),
            new DateFormat($boleto->f_partida, true, 'La fecha de partida no tiene el formato correcto'),
            new TimeFormat($boleto->h_partida, true, 'La hora de partida no tiene el formato correcto'),
            new Id($boleto->id_ruta, true, 'El id de la ruta no tiene el formato correcto'),
            new Id($boleto->id_paradero_origen, true, 'El id del paradero origen no tiene el formato correcto'),
            new Id($boleto->id_paradero_destino, true, 'El id del paradero destino no tiene el formato correcto'),
            new NumericFloat($boleto->precio),
            new NumericInteger($boleto->id_tipo_moneda->value),
            new NumericInteger($boleto->id_forma_pago->value),
            new NumericInteger((int)$boleto->obsequio),
            new Id($boleto->id_pos, true, 'El id del pos no tiene el formato correcto'),
            new Text($boleto->codigo, false, -1),
            new NumericFloat($boleto->latitud),
            new NumericFloat($boleto->longitud),
            new DateTimeFormat($boleto->f_emision),
            new NumericInteger($boleto->idEstado),
            new Id($boleto->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($boleto->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($boleto->f_registro),
            new DateTimeFormat($boleto->f_modifico),
            new NumericInteger($boleto->id_tipo_comprobante->value),
            new NumericInteger($boleto->id_tipo_boleto->value),
            new NumericInteger((int)$boleto->por_pagar),
        );
        $Cliente = $boleto->id_cliente ? Cliente::findOrFail($boleto->id_cliente, ['nombre']) : null;
        $OUTPUT->setCliente(new Text(($Cliente?->nombre), true, -1));

        $Vehiculo = $boleto->id_vehiculo ? Vehiculo::findOrFail($boleto->id_vehiculo, ['placa']) : null;
        $OUTPUT->setVehiculoPlaca(new Text(($Vehiculo?->placa), true, -1));

        $Ruta = $boleto->id_ruta ? Ruta::findOrFail($boleto->id_ruta, ['nombre']) : null;
        $OUTPUT->setRuta(new Text(($Ruta?->nombre), true, -1));

        $TipoDocumento = $boleto->id_tipo_documento ? TipoDocumento::findOrFail($boleto->id_tipo_documento->value, ['nombre_corto']) : null;
        $OUTPUT->setTipoDocumento(new Text(($TipoDocumento?->nombre_corto), true, -1));

        $Sede = $boleto->id_sede ? Sede::findOrFail($boleto->id_sede, ['nombre']) : null;
        $OUTPUT->setSede(new Text(($Sede?->nombre), true, -1));

        $Caja = $boleto->id_caja ? Caja::findOrFail($boleto->id_caja, ['nombre']) : null;
        $OUTPUT->setCaja(new Text(($Caja?->nombre), true, -1));

        $ParaderoOrigen = $boleto->id_paradero_origen ? Paradero::findOrFail($boleto->id_paradero_origen, ['nombre']) : null;
        $OUTPUT->setParaderoOrigen(new Text(($ParaderoOrigen?->nombre), true, -1));

        $ParaderoDestino = $boleto->id_paradero_destino ? Paradero::findOrFail($boleto->id_paradero_destino, ['nombre']) : null;
        $OUTPUT->setParaderoDestino(new Text(($ParaderoDestino?->nombre), true, -1));

        $UsuarioRegistro = $boleto->id_usu_registro ? User::findOrFail($boleto->id_usu_registro, ['nombres','apellidos']) : null;
        $OUTPUT->setUsuarioRegistro(new Text(($UsuarioRegistro?->nombres . ' ' . $UsuarioRegistro?->apellidos), true, -1));

        $UsuarioModifico = $boleto->id_usu_modifico ? User::findOrFail($boleto->id_usu_modifico, ['nombres','apellidos']) : null;
        $OUTPUT->setUsuarioModifico(new Text(($UsuarioModifico?->nombres . ' ' . $UsuarioModifico?->apellidos), true, -1));

        $TipoComprobante = $boleto->id_tipo_comprobante ? TipoComprobante::findOrFail($boleto->id_tipo_comprobante->value, ['nombre']) : null;
        $OUTPUT->setTipoComprobante(new Text(($TipoComprobante?->nombre), true, -1));

        return $OUTPUT;
    }


    public function reportTotalByCliente(
        Id $idCliente,
        Id $idUsuario,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        Id $idRuta,
        array $vehiculos
    ): array
    {

        $idVehiculos = array();
        if(count($vehiculos) > 0){
            $idVehiculos = $vehiculos;
        }else{
            $usuarioVehiculo = UsuarioVehiculo::where('id_usuario',$idUsuario->value())->get();
            if(!$usuarioVehiculo->isEmpty()){
                $vehiculos = json_decode($usuarioVehiculo->first()->vehiculos);
                if(count($vehiculos) > 1 ){
                    $idVehiculos = array_map(function($v){ return $v->id; }, $vehiculos);
                }else{
                    if($vehiculos[0]->id === '0'){
                        $vv = Vehiculo::select('id')->where('id_cliente', $idCliente->value())->get();
                        foreach ($vv as $v) {
                            $idVehiculos[] = $v->id;
                        }
                    }else{
                        $idVehiculos[] = $vehiculos[0]->id;
                    }

                }
            }
        }

        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'id_vehiculo',
                DB::raw('SUM(precio) as total'),
                'placa'
            )
            ->join('vehiculos','id_vehiculo','=','vehiculos.id')
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo . '.f_registro','>=',$fechaDesde->value())
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo . '.f_registro','<=',$fechaDesde->value())
            ->whereIn('id_vehiculo', $idVehiculos);

        if(!is_null($idRuta->value())) $models->where('id_ruta',$idRuta->value());

        $models->groupBy('id_vehiculo', 'vehiculos.placa');

        $models = $models->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincialVehiculo(
                new Id($model->id_vehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
                new Text($model->placa, false, -1 ,''),
                new NumericFloat($model->total),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function reporteTotalByVehiculoRangoFecha(
        Id $idCliente,
        Id $idVehiculo,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta
    ): array
    {

        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                DB::raw('date(f_registro) as fecha'),
                DB::raw('SUM(precio) as total')
            )
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo . '.f_registro','>=',$fechaDesde->value())
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo . '.f_registro','<=',$fechaDesde->value())
            ->where('id_vehiculo', $idVehiculo->value());

        $models->groupBy('fecha');

        $models = $models->get();

        $collection = array();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincialVehiculoRangoFecha(
                new DateFormat($model->fecha, false, 'La fecha no tiene el formato correcto'),
                new NumericFloat($model->total),
            );

            $collection[] = $OModel;
        }

        return $collection;
    }


    public function liquidacionTotalByVehiculoRangoFecha(
        Id $idCliente,
        array $idVehiculos,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta
    ): BoletoInterprovincialShortFechaList
    {

        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'id_vehiculo',
                DB::raw('date(f_registro) as fecha'),
                DB::raw('SUM(precio) as total')
            )
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo . '.f_registro','>=',$fechaDesde->value())
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo . '.f_registro','<=',$fechaHasta->value())
            ->whereIn('id_vehiculo', $idVehiculos)
            ->groupBy('fecha','id_vehiculo')
            ->get();

        $collection = new BoletoInterprovincialShortFechaList();

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincialShortFecha(
                $idCliente,
                new DateFormat($model->fecha, false, 'La fecha no tiene el formato correcto'),
                new NumericFloat($model->total),
            );
            $OModel->setIdVehiculo(new Id($model->id_vehiculo, false, 'El id del vehiculo no tiene el formato correcto'));

            $collection->add($OModel);
        }

        return $collection;
    }


    public function liquidacionByVehiculoFechaGroupRutaBoleto(
        Id $idCliente,
        array $idVehiculos,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta
    ): array
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'rutas.nombre as ruta',
                'id_ruta',
                'id_vehiculo',
                DB::raw('COUNT(precio) as cantidad'),
                'precio',
                DB::raw('SUM(precio) as total'),
                'f_partida as fecha'
            )
            ->join('rutas', 'boleto_interprovincial_cliente_' . $OCliente->codigo . '.id_ruta', '=', 'rutas.id')
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo . '.f_partida','>=',$fechaDesde->value())
            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo . '.f_partida','<=',$fechaHasta->value())
            ->whereIn('id_vehiculo', $idVehiculos)
            ->groupBy('rutas.nombre', 'id_ruta', 'id_vehiculo', 'precio', 'f_partida')
            ->orderBy('f_partida', 'asc')
            ->get();

        $collection = [];

        foreach ( $models as $model ){

            $OModel = new BoletoInterprovincialLiquidacionVehiculoFecha(
                new Id($model->id_ruta, false, 'El id de la ruta no tiene el formato correcto'),
                new Text($model->ruta, false, -1, ''),
                new Id($model->id_vehiculo, false, 'El id del vehiculo no tiene el formato correcto'),
                new NumericInteger($model->cantidad),
                new NumericFloat($model->precio),
                new NumericFloat($model->total),
                new DateFormat($model->fecha, false, 'La fecha no tiene el formato correcto'),
            );

            $collection[] = $OModel;
        }

        return $collection;
    }


    public function reporteTotalByVehiculoFecha(Id $idCliente, Id $idVehiculo, DateFormat $fecha): array
    {


        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'boleto_interprovincial_cliente_' . $OCliente->codigo .'.*',
                'ce_comprobante_electronico.serie as serie',
                'ce_comprobante_electronico.numero as numero',
                'tipo_comprobante.abreviatura as tipoComprobante',
                'origen_boleto.nombre as origen',
                'e_boleto_interprovincial.nombre as estado',
            )
            ->leftjoin('ce_comprobante_electronico',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id', '=', 'ce_comprobante_electronico.id_producto')
            ->leftjoin('origen_boleto',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_origen', '=', 'origen_boleto.id')
            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->leftjoin('e_boleto_interprovincial',  'boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_estado', '=', 'e_boleto_interprovincial.id')


            ->whereDate('boleto_interprovincial_cliente_' . $OCliente->codigo .'.f_registro','=',$fecha->value())
            ->where('boleto_interprovincial_cliente_' . $OCliente->codigo .'.id_vehiculo','=',$idVehiculo->value());

        $models = $models->orderBy('boleto_interprovincial_cliente_' . $OCliente->codigo .'.f_registro', 'DESC')->get();

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

            $Vehiculo = $model->id_vehiculo ? Vehiculo::findOrFail($model->id_vehiculo, ['placa']) : null;
            $OModel->setVehiculoPlaca(new Text(($Vehiculo?->placa), true, -1));

            $Ruta = $model->id_ruta ? Ruta::findOrFail($model->id_ruta, ['nombre']) : null;
            $OModel->setRuta(new Text(($Ruta?->nombre), true, -1));

            $TipoDocumento = $model->id_tipo_documento ? TipoDocumento::findOrFail($model->id_tipo_documento->value, ['nombre_corto']) : null;
            $OModel->setTipoDocumento(new Text(($TipoDocumento?->nombre_corto), true, -1));

            $Sede = $model->id_sede ? Sede::findOrFail($model->id_sede, ['nombre']) : null;
            $OModel->setSede(new Text(($Sede?->nombre), true, -1));

            $Caja = $model->id_caja ? Caja::findOrFail($model->id_caja, ['nombre']) : null;
            $OModel->setCaja(new Text(($Caja?->nombre), true, -1));

            $ParaderoOrigen = $model->id_paradero_origen ? Paradero::findOrFail($model->id_paradero_origen, ['nombre']) : null;
            $OModel->setParaderoOrigen(new Text(($ParaderoOrigen?->nombre), true, -1));

            $ParaderoDestino = $model->id_paradero_destino ? Paradero::findOrFail($model->id_paradero_destino, ['nombre']) : null;
            $OModel->setParaderoDestino(new Text(($ParaderoDestino?->nombre), true, -1));

            $UsuarioRegistro = $model->id_usu_registro ? User::findOrFail($model->id_usu_registro, ['nombres','apellidos']) : null;
            $OModel->setUsuarioRegistro(new Text(($UsuarioRegistro?->nombres . ' ' . $UsuarioRegistro?->apellidos), true, -1));

            $UsuarioModifico = $model->id_usu_modifico ? User::findOrFail($model->id_usu_modifico, ['nombres','apellidos']) : null;
            $OModel->setUsuarioModifico(new Text(($UsuarioModifico?->nombres . ' ' . $UsuarioModifico?->apellidos), true, -1));

            $OModel->setTipoComprobante(new Text($model->tipoComprobante, true, -1 , ''));
            $OModel->setComprobanteNumero(new NumericInteger($model->numero));
            $OModel->setComprobanteSerie(new Text($model->serie, true, -1, ''));
            $OModel->setIdOrigen(new NumericInteger($model->id_origen));
            $OModel->setOrigen(new Text($model->origen, true, -1, ''));
            $OModel->setEstado(new Text($model->estado, true, -1, ''));
            $OModel->setIdCajaDiario(new Id($model->id_caja_diario, true, 'El id de la caja diario no tiene el formato corercto'));
            $OModel->setIdLiquidacion(new Id($model->id_liquidacion, true, 'El id de la liquidación no tiene el formato corercto'));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function reporteTotalByClienteFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): BoletoInterprovincialShortFechaList
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $collection = new BoletoInterprovincialShortFechaList();

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'id_cliente',
                DB::raw('SUM(precio) as total'),
                DB::raw('DATE(f_registro) as fecha')
            )
            ->where('id_estado', 1)
            ->whereNotNull('id_vehiculo')
            ->whereDate('f_registro','>=', $fechaDesde->value())
            ->whereDate('f_registro','<=', $fechaHasta->value())
            ->groupBy('id_cliente',DB::raw('DATE(f_registro)'))
            ->get();

        foreach ( $models as $model ) {
            $Omodel = new BoletoInterprovincialShortFecha(
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new DateFormat($model->fecha,false,'La fecha no tiene el formato correcto'),
                new NumericFloat($model->total)
            );
            $collection->add($Omodel);
        }

        return $collection;
    }


    public function reporteTotalByClienteFechaGroupVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): BoletoInterprovincialShortFechaList
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $collection = new BoletoInterprovincialShortFechaList();

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'id_vehiculo',
                'id_cliente',
                DB::raw('SUM(precio) as total'),
                DB::raw('DATE(f_registro) as fecha')
            )
            ->where('id_estado', 1)
            ->whereNotNull('id_vehiculo')
            ->whereDate('f_registro','>=', $fechaDesde->value())
            ->whereDate('f_registro','<=', $fechaHasta->value())
            ->groupBy('id_vehiculo','id_cliente',DB::raw('DATE(f_registro)'))->get();

        foreach ( $models as $model ) {
            $Omodel = new BoletoInterprovincialShortFecha(
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new DateFormat($model->fecha,false,'La fecha no tiene el formato correcto'),
                new NumericFloat($model->total)
            );
            $Omodel->setIdVehiculo(new Id($model->id_vehiculo, false, 'El id del vehiculo no tiene el formato correcto'));
            $collection->add($Omodel);
        }

        return $collection;
    }

    public function pasajerosByVehiculoRangoFecha(
        Id $idCliente,
        Id $idVehiculo,
        DateTimeFormat $fechaDesde,
        DateTimeFormat $fechaHasta
    ): array
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $collection =  array();

        $models = $this->eloquentModelBoletoInterprovincial
            ->select(
                'nombres',
                'apellidos',
                'numero_documento',
                'tipo_documento.nombre_corto as tipo_documento',
                'paradero.nombre as destino',
                'f_partida',
                'h_partida'
            )
            ->join('tipo_documento', 'boleto_interprovincial_cliente_' . $OCliente->codigo . '.id_tipo_documento', '=', 'tipo_documento.id')
            ->join('paradero', 'boleto_interprovincial_cliente_' . $OCliente->codigo . '.id_paradero_destino', '=', 'paradero.id')
            //->where('boleto_interprovincial_cliente_' . $OCliente->codigo .'.id_estado', 1)
            ->whereNotNull('f_partida')
            ->whereNotNull('h_partida')
            ->whereDate('f_partida', '>=', $fechaDesde->date())
            ->whereDate('f_partida', '<=', $fechaHasta->date())
            ->whereTime('h_partida', '>=', $fechaDesde->time())
            ->whereTime('h_partida', '<=', $fechaHasta->time())
            ->where('id_vehiculo','=', $idVehiculo->value())
            ->orderBy('f_partida','asc')
            ->orderBy('h_partida','asc')
            ->get();

        foreach ( $models as $model ) {
            $Omodel = new BoletoInterprovincialPasajero(
                new Text($model->nombres, true, -1, ''),
                new Text($model->apellidos, true, -1, ''),
                new Text($model->tipo_documento, true, -1, ''),
                new Text($model->numero_documento, true, -1, ''),
                new Text($model->destino, true, -1, ''),
                new DateFormat($model->f_partida, false, ''),
                new TimeFormat($model->h_partida, false, ''),
            );
            $collection[] = $Omodel;
        }

        return $collection;
    }


    public function liquidar(
        Id $idCliente,
        Id $idLiquidacion,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        array $idVehiculos
    ): void
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);


        $this->eloquentModelBoletoInterprovincial
            ->where('id_estado',1)
            ->whereDate('f_registro', '>=', $fechaDesde->value())
            ->whereDate('f_registro', '<=', $fechaHasta->value())
            ->whereIn('id_vehiculo',$idVehiculos)
            ->whereNull('id_liquidacion')
            ->update([
                'id_liquidacion' => $idLiquidacion->value(),
                'id_estado' => EnumEstadoBoletoInterprovincial::Liquidado->value
            ]);
    }


    public function liberarLiquidacion(
        Id $idCliente,
        Id $idLiquidacion
    ): void
    {
        $OCliente = $this->eloquentClientModel->findOrFail($idCliente->value());
        $this->eloquentModelBoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);


        $this->eloquentModelBoletoInterprovincial
            ->where('id_liquidacion',$idLiquidacion->value())
            ->update([
                'id_liquidacion' => null,
                'id_estado' => EnumEstadoBoletoInterprovincial::Activo->value
            ]);
    }


}
