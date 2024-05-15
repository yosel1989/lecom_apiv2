<?php

declare(strict_types=1);

namespace Src\V2\CajaTraslado\Infrastructure\Repositories;

use App\Enums\EnumEstadoCajaTraslado;
use App\Enums\EnumTipoComprobante;
use App\Models\V2\Caja;
use App\Models\V2\CajaDiario;
use App\Models\V2\ComprobanteSerie;
use App\Models\V2\CajaTraslado as EloquentModelCajaTraslado;
use App\Models\V2\Sede;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\CajaTraslado\Domain\Contracts\CajaTrasladoRepositoryContract;
use Src\V2\CajaTraslado\Domain\CajaTraslado;
use Src\V2\CajaTraslado\Domain\CajaTrasladoGroupTipoFechaShort;
use Src\V2\CajaTraslado\Domain\CajaTrasladoGroupTipoFechaShortList;
use Src\V2\CajaTraslado\Domain\CajaTrasladoLiquidacionRangoFechaVehiculo;
use Src\V2\CajaTraslado\Domain\CajaTrasladoList;

final class EloquentCajaTrasladoRepository implements CajaTrasladoRepositoryContract
{
    private EloquentModelCajaTraslado $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelCajaTraslado;
    }

    public function create(
        Id $id,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoComprobante,
        Id $idPersonal,
        Id $idCajaOrigen,
        Id $idCajaDestino,
        NumericFloat $monto,
        Id $idUsuarioRegistro
    ): CajaTraslado
    {
        if($monto->value() === 0){
            throw new InvalidArgumentException('El monto debe ser mayor a 0');
        }

        // Validar sede
        $Sede = Sede::where('id', $idSede->value())->where('id_estado', 1)->where('id_eliminado',0)->where('id_cliente',$idCliente->value());
        if( $Sede->count() === 0 ){
            throw new InvalidArgumentException( 'La sede no se encuentra registrado en el sistema o esta inhabilitado.' );
        }


        // Validar serie
        $Serie = ComprobanteSerie::where('id_estado', 1)->where('id_cliente',$idCliente->value())->where('id_tipo_comprobante',EnumTipoComprobante::ComprobanteTrasladoDinero)->where('id_sede', $idSede->value());
        if( $Serie->count() === 0 ){
            throw new InvalidArgumentException( 'Falta registrar la serie en el sistema' );
        }
        if( $Serie->count() > 1 ){
            throw new InvalidArgumentException( 'Existe más de una serie registrada' );
        }

        // Obtener ultimo numero
        $ultimoNumero = $this->eloquent->select(DB::raw('MAX(numero) as ultimo_numero'))
            ->where('id_cliente', $idCliente->value())
            ->where('serie', $Serie->first()->nombre)
            ->first();



        // Validar caja origen
        $CajaOrigen = Caja::selectRaw('count(*) as total')->where('id', $idCajaOrigen->value())->where('id_estado', 1)->where('id_cliente',$idCliente->value())->where('id_eliminado',0)->first();
        if( $CajaOrigen->total === 0 ){
            throw new InvalidArgumentException( 'La caja origen no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar caja destino
        $CajaDestino = Caja::selectRaw('count(*) as total')->where('id', $idCajaDestino->value())->where('id_estado', 1)->where('id_cliente',$idCliente->value())->where('id_eliminado',0)->first();
        if( $CajaDestino->total === 0 ){
            throw new InvalidArgumentException( 'La caja destino no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar caja diario origen
        $CajaDiarioOrigen = CajaDiario::where('id_caja', $idCajaOrigen->value())->where('id_cliente',$idCliente->value())->where('id_estado', 1)->where('id_eliminado',0)->whereNull('f_cierre')->orderBy('f_apertura','DESC')->limit(1);
        if( $CajaDiarioOrigen->count() === 0 ){
            throw new InvalidArgumentException( 'La caja de origen no se encuentra aperturada' );
        }else{
            $fechaApertura = new \DateTime($CajaDiarioOrigen->first()->f_apertura);
            $hoy = new \DateTime('now');
            if($fechaApertura->format('Y-m-d') !== $hoy->format('Y-m-d')){
                throw new InvalidArgumentException( 'Debe realizar el cierre de caja en la caja origen' );
            }
        }


        // Validar caja diario destino
        $CajaDiarioDestino = CajaDiario::where('id_caja', $idCajaDestino->value())->where('id_cliente',$idCliente->value())->where('id_estado', 1)->where('id_eliminado',0)->whereNull('f_cierre')->orderBy('f_apertura','DESC')->limit(1);
        if( $CajaDiarioDestino->count() === 0 ){
            throw new InvalidArgumentException( 'La caja de destino no se encuentra aperturada' );
        }else{
            $fechaApertura = new \DateTime($CajaDiarioDestino->first()->f_apertura);
            $hoy = new \DateTime('now');
            if($fechaApertura->format('Y-m-d') !== $hoy->format('Y-m-d')){
                throw new InvalidArgumentException( 'Debe realizar el cierre de caja en la caja destino' );
            }
        }

        // Validar cliente
        $Cliente = \App\Models\V2\Cliente::where('id', $idCliente->value())->where('idEstado',1)->where('idEliminado',0);
        if( $Cliente->count() === 0 ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar personal
        $personal = \App\Models\V2\Personal::where('id', $idPersonal->value())->where('id_estado',1)->where('id_eliminado',0);
        if( $personal->count() === 0 ){
            throw new InvalidArgumentException( 'El personal no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        $this->eloquent->create([
            'id' => $id->value(),
            'id_cliente' => $idCliente->value(),
            'id_sede' => $idSede->value(),
            'id_tipo_comprobante' => $idTipoComprobante->value(),
            'serie' =>  $Serie->first()->nombre,
            'numero' =>  $ultimoNumero->ultimo_numero ? ($ultimoNumero->ultimo_numero + 1) : 1,
            'id_personal' => $idPersonal->value(),
            'id_caja_origen' => $idCajaOrigen->value(),
            'id_caja_diario_origen' => $CajaDiarioOrigen->first()->id,
            'id_caja_destino' => $idCajaDestino->value(),
            'id_caja_diario_destino' => $CajaDiarioDestino->first()->id,
            'monto' => $monto->value(),
            'id_estado' => 1,
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);


        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoComprobante:id,nombre,abreviatura',
            'sede:id,nombre',
            'cajaOrigen:id,nombre',
            'cajaDestino:id,nombre',
            'estado:id,nombre',
            'personal:id,nombre,apellido',
        )->findOrFail($id->value());
        $OModel = new CajaTraslado(
            new Id($model->id , false, 'El id del CajaTraslado no tiene el formato correcto'),
            new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante),
            new Text($model->serie, false, -1, ''),
            new NumericInteger($model->numero),
            new Id($model->id_personal ),
            new Id($model->id_caja_origen , false, 'El id de la caja  no tiene el formato correcto'),
            new Id($model->id_caja_destino , false, 'El id de la caja  no tiene el formato correcto'),
            new NumericFloat($model->monto),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text($model->sede->nombre, false, -1));
        $OModel->setTipoComprobante(new Text($model->tipoComprobante->abreviatura, false, -1));
        $OModel->setPersonal(new Text($model->personal->nombre. ' ' . $model->personal->apellido, false, -1));
        $OModel->setCajaOrigen(new Text($model->cajaOrigen->nombre, false, -1));
        $OModel->setCajaDestino(new Text($model->cajaDestino->nombre, false, -1));
        $OModel->setEstado(new Text($model->estado->nombre, false, -1));

        return $OModel;

    }

    public function delete(
        Id $id
    ): void
    {
        $this->eloquent->where('id',$id->value())->delete();
    }

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CajaTrasladoList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoComprobante:id,nombre,abreviatura',
            'sede:id,nombre',
            'cajaOrigen:id,nombre',
            'cajaDestino:id,nombre',
            'estado:id,nombre',
            'personal:id,nombre,apellido',
        )
//            ->leftJoin('CajaTraslado_detalle', 'CajaTraslado.id', '=', 'CajaTraslado_detalle.id_CajaTraslado')
//            ->leftjoin('ce_comprobante_electronico',  'CajaTraslado.id', '=', 'ce_comprobante_electronico.id_producto')
//            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->where('id_cliente',$idCliente->value())
            ->whereDate('f_registro','>=', $fechaDesde->value())
            ->whereDate('f_registro','<=', $fechaHasta->value());

        $models = $models->orderBy('f_registro', 'desc')
            ->get();


        $collection = new CajaTrasladoList();

        foreach ( $models as $model ){

            $OModel = new CajaTraslado(
                new Id($model->id , false, 'El id del CajaTraslado no tiene el formato correcto'),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_comprobante),
                new Text($model->serie, false, -1, ''),
                new NumericInteger($model->numero),
                new Id($model->id_personal ),
                new Id($model->id_caja_origen , false, 'El id de la caja  no tiene el formato correcto'),
                new Id($model->id_caja_destino , false, 'El id de la caja  no tiene el formato correcto'),
                new NumericFloat($model->monto),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );
            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text($model->sede->nombre, false, -1));
            $OModel->setTipoComprobante(new Text($model->tipoComprobante->abreviatura, false, -1));
            $OModel->setPersonal(new Text($model->personal->nombre. ' ' . $model->personal->apellido, false, -1));
            $OModel->setCajaOrigen(new Text($model->cajaOrigen->nombre, false, -1));
            $OModel->setCajaDestino(new Text($model->cajaDestino->nombre, false, -1));
            $OModel->setEstado(new Text($model->estado->nombre, false, -1));

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteByUsuario(Id $idCliente, Id $idUsuario, DateFormat $fecha): CajaTrasladoList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoComprobante:id,nombre,abreviatura',
            'sede:id,nombre',
            'cajaOrigen:id,nombre',
            'cajaDestino:id,nombre',
            'estado:id,nombre',
            'personal:id,nombre,apellido',
        )
//            ->leftjoin('ce_comprobante_electronico',  'CajaTraslado.id', '=', 'ce_comprobante_electronico.id_producto')
//            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->where('id_cliente',$idCliente->value())
            ->where('id_usu_registro',$idUsuario->value())
            ->whereDate('f_registro',$fecha->value())
            ->orderBy('f_registro', 'desc')
            ->get();

        $collection = new CajaTrasladoList();

        foreach ( $models as $model ){

            $OModel = new CajaTraslado(
                new Id($model->id , false, 'El id del CajaTraslado no tiene el formato correcto'),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_comprobante),
                new Text($model->serie, false, -1, ''),
                new NumericInteger($model->numero),
                new Id($model->id_personal ),
                new Id($model->id_caja_origen , false, 'El id de la caja  no tiene el formato correcto'),
                new Id($model->id_caja_destino , false, 'El id de la caja  no tiene el formato correcto'),
                new NumericFloat($model->monto),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );
            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text($model->sede->nombre, false, -1));
            $OModel->setTipoComprobante(new Text($model->tipoComprobante->abreviatura, false, -1));
            $OModel->setPersonal(new Text($model->personal->nombre. ' ' . $model->personal->apellido, false, -1));
            $OModel->setCajaOrigen(new Text($model->cajaOrigen->nombre, false, -1));
            $OModel->setCajaDestino(new Text($model->cajaDestino->nombre, false, -1));
            $OModel->setEstado(new Text($model->estado->nombre, false, -1));

            $collection->add($OModel);
        }

        return $collection;
    }

    public function find(
        Id $idCajaTraslado,
    ): CajaTraslado
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->findOrFail($idCajaTraslado->value());
        $OModel = new CajaTraslado(
            new Id($model->id , false, 'El id del CajaTraslado no tiene el formato correcto'),
            new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
            new Id($model->id_vehiculo , true, 'El id del vehiculo tipo no tiene el formato correcto'),
            new Id($model->id_personal , true, 'El id del personal tipo no tiene el formato correcto'),
            new Id($model->id_caja , false, 'El id de la caja  no tiene el formato correcto'),
            new Id($model->id_caja_diario , false, 'El id de la caja diario tipo no tiene el formato correcto'),
            new NumericFloat($model->total),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

        return $OModel;
    }


    public function findPdf(
        Id $idCajaTraslado,
    ): CajaTraslado
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoComprobante:id,nombre',
            'sede:id,nombre',
            'caja:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'vehiculo:id,placa',
            'personal:id,nombre,apellido',
        )->findOrFail($idCajaTraslado->value());
        $OModel = new CajaTraslado(
            new Id($model->id , false, 'El id del CajaTraslado no tiene el formato correcto'),
            new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante),
            new Text($model->serie, false, -1, ''),
            new NumericInteger($model->numero),
            new NumericInteger($model->id_tipo_documento_entidad ),
            new Text($model->numero_documento_entidad, false, -1, ''),
            new Text($model->nombre_entidad, false, -1, ''),
            new Id($model->id_vehiculo , true, 'El id del vehiculo tipo no tiene el formato correcto'),
            new Id($model->id_personal , true, 'El id del personal tipo no tiene el formato correcto'),
            new Id($model->id_caja , false, 'El id de la caja  no tiene el formato correcto'),
            new Id($model->id_caja_diario , false, 'El id de la caja diario tipo no tiene el formato correcto'),
            new NumericFloat($model->total),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text($model->sede->nombre, false, -1));
        $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
        $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
        $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
        $OModel->setVehiculo(new Text($model->vehiculo?->placa, true, -1));
//            $OModel->setIdVehiculo(new Id($model->vehiculo?->id, true));
        $OModel->setPersonal(new Text($model->personal ? ($model->personal->nombre . ' ' . $model->personal->apellido) : null, true, -1));
//            $OModel->setIdPersonal(new Id($model->personal?->id, true));
        $OModel->setEstado(new Text($model->estado->nombre, false, -1));

        return $OModel;
    }



    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CajaTrasladoGroupTipoFechaShortList
    {
        $collection = new CajaTrasladoGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'CajaTraslado.id_cliente',
                'CajaTraslado_detalle.id_CajaTraslado_tipo',
                'CajaTraslado_tipo.nombre as tipo',
                DB::raw('SUM(CajaTraslado_detalle.importe) as total'),
                DB::raw('DATE(CajaTraslado_detalle.fecha) as fecha')
            )
            ->join('CajaTraslado_detalle', 'CajaTraslado.id','=','CajaTraslado_detalle.id_CajaTraslado')
            ->join('CajaTraslado_tipo', 'CajaTraslado_detalle.id_CajaTraslado_tipo','=','CajaTraslado_tipo.id')
            ->where('CajaTraslado.id_cliente',$idCliente->value())
            ->whereDate('CajaTraslado_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('CajaTraslado_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('CajaTraslado.id_cliente', 'CajaTraslado_detalle.fecha', 'CajaTraslado_detalle.id_CajaTraslado_tipo', 'CajaTraslado_tipo.nombre')
            ->get();


        foreach ( $models as $model ){

            $OModel = new CajaTrasladoGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del CajaTraslado no tiene el formato correcto'),
                new Id($model->id_CajaTraslado_tipo , false, 'El id del cliente no tiene el formato correcto'),
                new Text($model->tipo , true, -1, ''),
                new NumericFloat($model->total ),
                new DateFormat($model->fecha , false, 'El id de la caja  no tiene el formato correcto')
            );

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CajaTrasladoGroupTipoFechaShortList
    {
        $collection = new CajaTrasladoGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'CajaTraslado.id_cliente',
                'CajaTraslado.id_vehiculo',
                'CajaTraslado_detalle.id_CajaTraslado_tipo',
                'CajaTraslado_tipo.nombre as tipo',
                DB::raw('SUM(CajaTraslado_detalle.importe) as total'),
                DB::raw('DATE(CajaTraslado_detalle.fecha) as fecha')
            )
            ->join('CajaTraslado_detalle', 'CajaTraslado.id','=','CajaTraslado_detalle.id_CajaTraslado')
            ->join('CajaTraslado_tipo', 'CajaTraslado_detalle.id_CajaTraslado_tipo','=','CajaTraslado_tipo.id')
            ->where('CajaTraslado.id_cliente',$idCliente->value())
            ->whereDate('CajaTraslado_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('CajaTraslado_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('CajaTraslado.id_cliente', 'CajaTraslado_detalle.fecha', 'CajaTraslado_detalle.id_CajaTraslado_tipo', 'CajaTraslado_tipo.nombre', 'CajaTraslado.id_vehiculo')
            ->get();


        foreach ( $models as $model ){

            $OModel = new CajaTrasladoGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del CajaTraslado no tiene el formato correcto'),
                new Id($model->id_CajaTraslado_tipo , false, 'El id del cliente no tiene el formato correcto'),
                new Text($model->tipo , true, -1, ''),
                new NumericFloat($model->total ),
                new DateFormat($model->fecha , false, 'El id de la caja  no tiene el formato correcto')
            );
            $OModel->setIdVehiculo(new Id($model->id_vehiculo, true, 'El id del vehiculo no tiene el formato correcto'));

            $collection->add($OModel);
        }

        return $collection;
    }

    public function liquidacionTotalByVehiculoRangoFecha(Id $idCliente, array $idVehiculos, DateFormat $fechaDesde, DateFormat $fechaHasta): array
    {
        $collection = array();

        $models = $this->eloquent
            ->select(
                'CajaTraslado.id_vehiculo',
                'CajaTraslado_detalle.id_CajaTraslado_tipo',
                'CajaTraslado_detalle.detalle',
                'CajaTraslado_tipo.nombre as CajaTraslado_tipo',
                DB::raw('SUM(CajaTraslado_detalle.importe) as total'),
                DB::raw('DATE(CajaTraslado_detalle.fecha) as fecha')
            )
            ->join('CajaTraslado_detalle', 'CajaTraslado.id','=','CajaTraslado_detalle.id_CajaTraslado')
            ->join('CajaTraslado_tipo', 'CajaTraslado_detalle.id_CajaTraslado_tipo','=','CajaTraslado_tipo.id')
            ->where('CajaTraslado.id_cliente',$idCliente->value())
            ->whereDate('CajaTraslado_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('CajaTraslado_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('CajaTraslado.id_vehiculo', 'CajaTraslado_detalle.id_CajaTraslado_tipo', 'CajaTraslado_detalle.detalle', 'CajaTraslado_tipo.nombre', 'CajaTraslado_detalle.fecha')
            ->get();

        foreach ( $models as $model ){

            $OModel = new CajaTrasladoLiquidacionRangoFechaVehiculo(
                new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->id_CajaTraslado_tipo , false, 'El id del CajaTraslado tipo no tiene el formato correcto'),
                new Text($model->CajaTraslado_tipo , false, -1, ''),
                new Text($model->detalle , false, -1, ''),
                new DateFormat($model->fecha , false, 'La fecha no tiene el formato correcto'),
                new NumericFloat($model->total),
            );

            $collection[] = $OModel;
        }

        return $collection;
    }

    public function anular(
        Id $id,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'id_estado' => EnumEstadoCajaTraslado::Anulado->value,
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

}
