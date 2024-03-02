<?php

declare(strict_types=1);

namespace Src\V2\Ingreso\Infrastructure\Repositories;

use App\Enums\EnumTipoComprobante;
use App\Models\V2\Caja;
use App\Models\V2\CajaDiario;
use App\Models\V2\ComprobanteSerie;
use App\Models\V2\Ingreso as EloquentModelIngreso;
use App\Models\V2\Sede;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Ingreso\Domain\Contracts\IngresoRepositoryContract;
use Src\V2\Ingreso\Domain\Ingreso;
use Src\V2\Ingreso\Domain\IngresoList;

final class EloquentIngresoRepository implements IngresoRepositoryContract
{
    private EloquentModelIngreso $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelIngreso;
    }

    public function create(
        Id $id,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoComprobante,
        Id $idTipoIngreso,
        Text $detalle,
        NumericInteger $idTipoDocumentoEntidad,
        Text $numeroDocumentoEntidad,
        Text $nombreEntidad,
        NumericFloat $importe,
        Id $idCaja,
        Id $idCajaDiario,
        ValueBoolean $ccontabilizado,
        ValueBoolean $aprobado,
        ValueBoolean $revisado,
        NumericInteger $idMedioPago,
        Text $numeroOperacion,
        NumericInteger $idEntidadFinanciera,
        Id $idUsuarioRegistro
    ): Ingreso
    {
        if($importe->value() === 0){
            throw new InvalidArgumentException('El importe debe ser mayor a 0');
        }

        // Validar sede
        $Sede = Sede::where('id', $idSede->value())->where('id_estado', 1)->where('id_eliminado',0)->where('id_cliente',$idCliente->value());
        if( $Sede->count() === 0 ){
            throw new InvalidArgumentException( 'La sede no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar codigo sede
        if( is_null($Sede->first()->codigo) ){
            throw new InvalidArgumentException( 'Falta ingresar el código de la sede' );
        }

        // Validar serie
        $Serie = ComprobanteSerie::where('id_cliente', $idCliente->value())
            ->where('id_sede', $idSede->value())
            ->where('id_tipo_comprobante', EnumTipoComprobante::ComprobanteIngreso->value)
            ->where('id_estado', 1);

        if($Serie->count() === 0){
            throw new \InvalidArgumentException('Falta registrar la serie para esta operación');
        }
        if($Serie->count() > 1){
            throw new \InvalidArgumentException('Existe más de una serie para esta operación');
        }

        // Obtener ultimo numero
        $ultimoNumero = $this->eloquent->select(DB::raw('MAX(numero) as ultimo_numero'))
            ->where('id_cliente', $idCliente->value())
            ->where('serie', $Serie->first()->nombre)
            ->first();

        // Validar caja
        $Caja = Caja::selectRaw('count(*) as total')->where('id', $idCaja->value())->where('id_estado', 1)->where('id_cliente',$idCliente->value())->where('id_eliminado',0)->first();
        if( $Caja->total === 0 ){
            throw new InvalidArgumentException( 'La caja no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar caja diario
        $CajaDiario = CajaDiario::selectRaw('count(*) as total')->where('id', $idCajaDiario->value())->where('id_cliente',$idCliente->value())->where('id_estado', 1)->where('id_eliminado',0)->whereNull('f_cierre')->first();
        if( $CajaDiario->total === 0 ){
            throw new InvalidArgumentException( 'La caja no se encuentra aperturada' );
        }

        // Validar cliente
        $Cliente = \App\Models\V2\Cliente::where('id', $idCliente->value())->where('idEstado',1)->where('idEliminado',0);
        if( $Cliente->count() === 0 ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar tipo de ingreso
        $ingresoTipo = \App\Models\V2\IngresoTipo::where('id', $idTipoIngreso->value())->where('id_estado',1)->where('id_eliminado',0);
        if( $ingresoTipo->count() === 0 ){
            throw new InvalidArgumentException( 'El tipo de ingreso no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar tipo de documento de identidad
        $tipoDocumento = \App\Models\V2\TipoDocumento::where('id', $idTipoDocumentoEntidad->value());
        if( $tipoDocumento->count() === 0 ){
            throw new InvalidArgumentException( 'El tipo de documento no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar tipo de documento de identidad
        $medioPago = \App\Models\V2\MedioPago::where('id', $idMedioPago->value());
        if( $medioPago->count() === 0 ){
            throw new InvalidArgumentException( 'El medio de pago no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar entidad financiera
        if(!is_null($idEntidadFinanciera->value())){
            $entidadFinanciera = \App\Models\V2\EntidadFinanciera::where('id', $idEntidadFinanciera->value());
            if( $entidadFinanciera->count() === 0 ){
                throw new InvalidArgumentException( 'La entidad financiera no se encuentra registrado en el sistema o esta inhabilitado.' );
            }
        }


        $this->eloquent->create([
            'id' => $id->value(),
            'id_cliente' => $idCliente->value(),
            'id_sede' => $idSede->value(),
            'id_tipo_comprobante' => $idTipoComprobante->value(),
            'serie' =>  $Serie->first()->nombre,
            'numero' =>  $ultimoNumero->ultimo_numero ? ($ultimoNumero->ultimo_numero + 1) : 1,
            'id_tipo_ingreso' => $idTipoIngreso->value(),
            'detalle' => $detalle->value(),
            'id_tipo_documento_entidad' => $idTipoDocumentoEntidad->value(),
            'numero_documento_entidad' => $numeroDocumentoEntidad->value(),
            'nombre_entidad' => $nombreEntidad->value(),
            'importe' => $importe->value(),
            'id_caja' => $idCaja->value(),
            'id_caja_diario' => $idCajaDiario->value(),

            'bl_contabilizado' => $ccontabilizado->value(),
            'bl_aprobado' => $aprobado->value(),
            'bl_revisado' => $revisado->value(),

            'id_medio_pago' => $idMedioPago->value(),
            'numero_operacion' => $numeroOperacion->value(),
            'id_entidad_financiera' => $idEntidadFinanciera->value(),

            'id_estado' => 1,
            'id_usu_registro' => $idUsuarioRegistro->value(),
        ]);


        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'sede:id,nombre',
            'caja:id,nombre',
            'tipoComprobante:id,nombre',
            'tipoIngreso:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'medioPago:id,nombre',
            'entidadFinanciera:id,nombre',
        )->findOrFail($id->value());
        $OModel = new Ingreso(
            new Id($model->id, false, 'El id del ingreso no tiene el formato correcto'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede, false, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante),
            new Text($model->serie, false, -1 , ''),
            new NumericInteger($model->numero),
            new Id($model->id_tipo_ingreso, false, 'El id del tipo de ingreso no tiene el formato correcto'),
            new Text($model->detalle, true, -1 , ''),
            new NumericInteger($model->id_tipo_documento_entidad),
            new Text($model->numero_documento_entidad, false, -1 , ''),
            new Text($model->nombre_entidad, false, -1 , ''),
            new NumericFloat($model->importe),

            new Id($model->id_caja, false, 'El id de la caja no tiene el formato correcto'),
            new Id($model->id_caja_diario, false, 'El id de la caja diario no tiene el formato correcto'),
            new ValueBoolean($model->bl_contabilizado),
            new ValueBoolean($model->bl_aprobado),
            new ValueBoolean($model->bl_revisado),
            new NumericInteger($model->id_medio_pago),
            new Text($model->numero_operacion, false, -1 , ''),
            new NumericInteger($model->id_entidad_financiera),

            new NumericInteger($model->id_estado),
            new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'La fecha que registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'La fecha que modifico no tiene el formato correcto')
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text($model->sede->nombre, false, -1));
        $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
        $OModel->setTipoIngreso(new Text($model->tipoIngreso->nombre, false, -1));
        $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
        $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1));
        $OModel->setEntidadFinanciera(new Text($model->entidadFinanciera?->nombre, true, -1));
        $OModel->setCaja(new Text($model->caja?->nombre, false, -1));

        return $OModel;

    }

    public function delete(
        Id $id
    ): void
    {
        $this->eloquent->where('id',$id->value())->delete();
    }

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): IngresoList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'sede:id,nombre',
            'caja:id,nombre',
            'tipoComprobante:id,nombre',
            'tipoIngreso:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'medioPago:id,nombre',
            'entidadFinanciera:id,nombre',
        )
            ->where('id_cliente',$idCliente->value())
            ->whereDate('f_registro','>=', $fechaDesde->value())
            ->whereDate('f_registro','<=', $fechaHasta->value());

//        if(!is_null($idVehiculo->value())){
//            $models = $models->where('ingreso.id_vehiculo', $idVehiculo->value());
//        }
//        if(!is_null($idPersonal->value())){
//            $models = $models->where('ingreso.id_personal', $idPersonal->value());
//        }

        $models = $models->orderBy('f_registro', 'desc')
            ->get();


        $collection = new IngresoList();

        foreach ( $models as $model ){

            $OModel = new Ingreso(
                new Id($model->id, false, 'El id del ingreso no tiene el formato correcto'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_comprobante),
                new Text($model->serie, false, -1 , ''),
                new NumericInteger($model->numero),
                new Id($model->id_tipo_ingreso, false, 'El id del tipo de ingreso no tiene el formato correcto'),
                new Text($model->detalle, true, -1 , ''),
                new NumericInteger($model->id_tipo_documento_entidad),
                new Text($model->numero_documento_entidad, false, -1 , ''),
                new Text($model->nombre_entidad, false, -1 , ''),
                new NumericFloat($model->importe),

                new Id($model->id_caja, false, 'El id de la caja no tiene el formato correcto'),
                new Id($model->id_caja_diario, false, 'El id de la caja diario no tiene el formato correcto'),
                new ValueBoolean($model->bl_contabilizado),
                new ValueBoolean($model->bl_aprobado),
                new ValueBoolean($model->bl_revisado),
                new NumericInteger($model->id_medio_pago),
                new Text($model->numero_operacion, false, -1 , ''),
                new NumericInteger($model->id_entidad_financiera),

                new NumericInteger($model->id_estado),
                new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'La fecha que registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'La fecha que modifico no tiene el formato correcto')
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text($model->sede->nombre, false, -1));
            $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
            $OModel->setTipoIngreso(new Text($model->tipoIngreso->nombre, false, -1));
            $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
            $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1));
            $OModel->setEntidadFinanciera(new Text($model->entidadFinanciera?->nombre, true, -1));
            $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
            $OModel->setEstado(new Text($model->estado?->nombre, false, -1));

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteDespachoByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): IngresoList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'sede:id,nombre',
            'caja:id,nombre',
            'tipoComprobante:id,nombre',
            'tipoIngreso:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'medioPago:id,nombre',
            'entidadFinanciera:id,nombre',
            'estado:id,nombre',
        )
            ->where('id_cliente',$idCliente->value())
            ->where('id_usu_registro',$idUsuario->value())
            ->whereDate('f_registro',$fecha->value())
            ->orderBy('f_registro', 'desc')
            ->get();

        $collection = new IngresoList();

        foreach ( $models as $model ){

            $OModel = new Ingreso(
                new Id($model->id, false, 'El id del ingreso no tiene el formato correcto'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_comprobante),
                new Text($model->serie, false, -1 , ''),
                new NumericInteger($model->numero),
                new Id($model->id_tipo_ingreso, false, 'El id del tipo de ingreso no tiene el formato correcto'),
                new Text($model->detalle, true, -1 , ''),
                new NumericInteger($model->id_tipo_documento_entidad),
                new Text($model->numero_documento_entidad, false, -1 , ''),
                new Text($model->nombre_entidad, false, -1 , ''),
                new NumericFloat($model->importe),

                new Id($model->id_caja, false, 'El id de la caja no tiene el formato correcto'),
                new Id($model->id_caja_diario, false, 'El id de la caja diario no tiene el formato correcto'),
                new ValueBoolean($model->bl_contabilizado),
                new ValueBoolean($model->bl_aprobado),
                new ValueBoolean($model->bl_revisado),
                new NumericInteger($model->id_medio_pago),
                new Text($model->numero_operacion, false, -1 , ''),
                new NumericInteger($model->id_entidad_financiera),

                new NumericInteger($model->id_estado),
                new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'La fecha que registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'La fecha que modifico no tiene el formato correcto')
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text($model->sede->nombre, false, -1));
            $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
            $OModel->setTipoIngreso(new Text($model->tipoIngreso->nombre, false, -1));
            $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
            $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1));
            $OModel->setEntidadFinanciera(new Text($model->entidadFinanciera?->nombre, true, -1));
            $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
            $OModel->setEstado(new Text($model->estado?->nombre, false, -1));

            $collection->add($OModel);
        }

        return $collection;
    }

    public function find(
        Id $idIngreso,
    ): Ingreso
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'sede:id,nombre',
            'caja:id,nombre',
            'tipoComprobante:id,nombre',
            'tipoIngreso:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'medioPago:id,nombre',
            'entidadFinanciera:id,nombre',
            'estado:id,nombre',
        )->findOrFail($idIngreso->value());
        $OModel = new Ingreso(
            new Id($model->id, false, 'El id del ingreso no tiene el formato correcto'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede, false, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante),
            new Text($model->serie, false, -1 , ''),
            new NumericInteger($model->numero),
            new Id($model->id_tipo_ingreso, false, 'El id del tipo de ingreso no tiene el formato correcto'),
            new Text($model->detalle, true, -1 , ''),
            new NumericInteger($model->id_tipo_documento_entidad),
            new Text($model->numero_documento_entidad, false, -1 , ''),
            new Text($model->nombre_entidad, false, -1 , ''),
            new NumericFloat($model->importe),

            new Id($model->id_caja, false, 'El id de la caja no tiene el formato correcto'),
            new Id($model->id_caja_diario, false, 'El id de la caja diario no tiene el formato correcto'),
            new ValueBoolean($model->bl_contabilizado),
            new ValueBoolean($model->bl_aprobado),
            new ValueBoolean($model->bl_revisado),
            new NumericInteger($model->id_medio_pago),
            new Text($model->numero_operacion, false, -1 , ''),
            new NumericInteger($model->id_entidad_financiera),

            new NumericInteger($model->id_estado),
            new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'La fecha que registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'La fecha que modifico no tiene el formato correcto')
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text($model->sede->nombre, false, -1));
        $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
        $OModel->setTipoIngreso(new Text($model->tipoIngreso->nombre, false, -1));
        $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
        $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1));
        $OModel->setEntidadFinanciera(new Text($model->entidadFinanciera?->nombre, true, -1));
        $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
        $OModel->setEstado(new Text($model->estado?->nombre, false, -1));
        return $OModel;
    }

    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): IngresoGroupTipoFechaShortList
    {
        $collection = new IngresoGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'ingreso.id_cliente',
                'ingreso_detalle.id_ingreso_tipo',
                'ingreso_tipo.nombre as tipo',
                DB::raw('SUM(ingreso_detalle.importe) as total'),
                DB::raw('DATE(ingreso_detalle.fecha) as fecha')
            )
            ->join('ingreso_detalle', 'ingreso.id','=','ingreso_detalle.id_ingreso')
            ->join('ingreso_tipo', 'ingreso_detalle.id_ingreso_tipo','=','ingreso_tipo.id')
            ->where('ingreso.id_cliente',$idCliente->value())
            ->whereDate('ingreso_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('ingreso_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('ingreso.id_cliente', 'ingreso_detalle.fecha', 'ingreso_detalle.id_ingreso_tipo', 'ingreso_tipo.nombre')
            ->get();


        foreach ( $models as $model ){

            $OModel = new IngresoGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del ingreso no tiene el formato correcto'),
                new Id($model->id_ingreso_tipo , false, 'El id del cliente no tiene el formato correcto'),
                new Text($model->tipo , true, -1, ''),
                new NumericFloat($model->total ),
                new DateFormat($model->fecha , false, 'El id de la caja  no tiene el formato correcto')
            );

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): IngresoGroupTipoFechaShortList
    {
        $collection = new IngresoGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'ingreso.id_cliente',
                'ingreso.id_vehiculo',
                'ingreso_detalle.id_ingreso_tipo',
                'ingreso_tipo.nombre as tipo',
                DB::raw('SUM(ingreso_detalle.importe) as total'),
                DB::raw('DATE(ingreso_detalle.fecha) as fecha')
            )
            ->join('ingreso_detalle', 'ingreso.id','=','ingreso_detalle.id_ingreso')
            ->join('ingreso_tipo', 'ingreso_detalle.id_ingreso_tipo','=','ingreso_tipo.id')
            ->where('ingreso.id_cliente',$idCliente->value())
            ->whereDate('ingreso_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('ingreso_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('ingreso.id_cliente', 'ingreso_detalle.fecha', 'ingreso_detalle.id_ingreso_tipo', 'ingreso_tipo.nombre', 'ingreso.id_vehiculo')
            ->get();


        foreach ( $models as $model ){

            $OModel = new IngresoGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del ingreso no tiene el formato correcto'),
                new Id($model->id_ingreso_tipo , false, 'El id del cliente no tiene el formato correcto'),
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
                'ingreso.id_vehiculo',
                'ingreso_detalle.id_ingreso_tipo',
                'ingreso_detalle.detalle',
                'ingreso_tipo.nombre as ingreso_tipo',
                DB::raw('SUM(ingreso_detalle.importe) as total'),
                DB::raw('DATE(ingreso_detalle.fecha) as fecha')
            )
            ->join('ingreso_detalle', 'ingreso.id','=','ingreso_detalle.id_ingreso')
            ->join('ingreso_tipo', 'ingreso_detalle.id_ingreso_tipo','=','ingreso_tipo.id')
            ->where('ingreso.id_cliente',$idCliente->value())
            ->whereDate('ingreso_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('ingreso_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('ingreso.id_vehiculo', 'ingreso_detalle.id_ingreso_tipo', 'ingreso_detalle.detalle', 'ingreso_tipo.nombre', 'ingreso_detalle.fecha')
            ->get();

        foreach ( $models as $model ){

            $OModel = new IngresoLiquidacionRangoFechaVehiculo(
                new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->id_ingreso_tipo , false, 'El id del ingreso tipo no tiene el formato correcto'),
                new Text($model->ingreso_tipo , false, -1, ''),
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
            'id_estado' => EnumEstadoIngreso::Anulado->value,
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

}
