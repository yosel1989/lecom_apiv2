<?php

declare(strict_types=1);

namespace Src\V2\Egreso\Infrastructure\Repositories;

use App\Enums\EnumEstadoEgreso;
use App\Enums\EnumTipoComprobante;
use App\Models\V2\Caja;
use App\Models\V2\CajaDiario;
use App\Models\V2\ComprobanteSerie;
use App\Models\V2\Egreso as EloquentModelEgreso;
use App\Models\V2\EgresoCategoria;
use App\Models\V2\EgresoTipo;
use App\Models\V2\MedioPago;
use App\Models\V2\Sede;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\Egreso\Domain\EgresoGroupTipoFechaShort;
use Src\V2\Egreso\Domain\EgresoGroupTipoFechaShortList;
use Src\V2\Egreso\Domain\EgresoLiquidacionRangoFechaVehiculo;
use Src\V2\Egreso\Domain\EgresoList;

final class EloquentEgresoRepository implements EgresoRepositoryContract
{
    private EloquentModelEgreso $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelEgreso;
    }

    public function create(
        Id $id,
        NumericInteger $idOrigen,
        Id $idCliente,
        NumericInteger $idTipoComprobante,
//        Text $serie,
//        NumericInteger $numero,
        Id $idCategoria,
        Id $idTipo,
        Text $detalle,
        NumericInteger $idTipoDocumentoEntidad,
        Text $numeroDocumentoEntidad,
        Text $nombreEntidad,
        Id $idSede,
        NumericFloat $monto,
        NumericInteger $idMedioPago,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idCaja,
        Id $idCajaDiario,
        DateFormat $fecha,
        Id $idUsuarioRegistro
    ): Egreso
    {
        // validar monto > 0
        if($monto->value() === 0){
            throw new InvalidArgumentException('El total debe ser mayor a 0');
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
        $Serie = ComprobanteSerie::where('id_estado', 1)->where('id_cliente',$idCliente->value())->where('id_tipo_comprobante',EnumTipoComprobante::TicketEgreso)->where('id_sede', $idSede->value());
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

        // Validar caja
        $Caja = Caja::selectRaw('count(*) as total')->where('id', $idCaja->value())->where('id_estado', 1)->where('id_cliente',$idCliente->value())->where('id_eliminado',0)->first();
        if( $Caja->total === 0 ){
            throw new InvalidArgumentException( 'La caja no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar caja diario
        $CajaDiario = CajaDiario::where('id', $idCajaDiario->value())->where('id_cliente',$idCliente->value())->where('id_estado', 1)->where('id_eliminado',0)->whereNull('f_cierre');
        if( $CajaDiario->count() === 0 ){
            throw new InvalidArgumentException( 'La caja no se encuentra aperturada' );
        }else{
            $fechaApertura = new \DateTime($CajaDiario->first()->f_apertura);
            $hoy = new \DateTime('now');
            if($fechaApertura->format('Y-m-d') !== $hoy->format('Y-m-d')){
                throw new InvalidArgumentException( 'Debe realizar el cierre de caja' );
            }
        }


        // validar categoria
        $Categoria = EgresoCategoria::where('id', $idCategoria->value())->where('id_estado', 1)->where('id_eliminado',0)->where('id_cliente',$idCliente->value());
        if( $Categoria->count() === 0 ){
            throw new InvalidArgumentException( 'La categoria no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // validar medio pago
        $MedioPago = MedioPago::where('id', $idMedioPago->value());
        if( $Categoria->count() === 0 ){
            throw new InvalidArgumentException( 'El medio de pago no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // validar tipo
        $Tipo = EgresoTipo::where('id', $idTipo->value())->where('id_estado', 1)->where('id_eliminado',0)->where('id_cliente',$idCliente->value());
        if( $Tipo->count() === 0 ){
            throw new InvalidArgumentException( 'El tipo no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar cliente
        $Cliente = \App\Models\V2\Cliente::where('id', $idCliente->value())->where('idEstado',1)->where('idEliminado',0);
        if( $Cliente->count() === 0 ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar vehiculo
        if(!is_null($idVehiculo->value())){
            $Vehiculo = \App\Models\V2\Vehiculo::where('id', $idVehiculo->value())->where('id_cliente', $idCliente->value())->where('id_estado',1)->where('id_eliminado',0);
            if( $Vehiculo->count() === 0 ){
                throw new InvalidArgumentException( 'El vehiculo no se encuentra registrado en el sistema o esta inhabilitado.' );
            }
        }

        // Validar personal
        if(!is_null($idPersonal->value())){
            $Personal = \App\Models\V2\Personal::where('id', $idPersonal->value())->where('id_cliente', $idCliente->value())->where('id_estado',1)->where('id_eliminado',0);
            if( $Personal->count() === 0 ){
                throw new InvalidArgumentException( 'El personal no se encuentra registrado en el sistema o esta inhabilitado.' );
            }
        }

        // Validar tipo de documento de identidad
        $tipoDocumento = \App\Models\V2\TipoDocumento::where('id', $idTipoDocumentoEntidad->value());
        if( $tipoDocumento->count() === 0 ){
            throw new InvalidArgumentException( 'El tipo de documento no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        $this->eloquent->create([
            'id' => $id->value(),
            'id_origen' => $idOrigen->value(),
            'id_cliente' => $idCliente->value(),
            'id_tipo_comprobante' => $idTipoComprobante->value(),
            'serie' =>  $Serie->first()->nombre,
            'numero' =>  $ultimoNumero->ultimo_numero ? ($ultimoNumero->ultimo_numero + 1) : 1,
            'id_egreso_categoria' =>  $idCategoria->value(),
            'id_egreso_tipo' => $idTipo->value(),
            'detalle' => $detalle->value(),
            'id_tipo_documento_entidad' => $idTipoDocumentoEntidad->value(),
            'numero_documento_entidad' => $numeroDocumentoEntidad->value(),
            'nombre_entidad' => $nombreEntidad->value(),
            'id_sede' => $idSede->value(),
            'monto' => $monto->value(),
            'id_medio_pago' => $MedioPago->first()->id,
            'id_vehiculo' => $idVehiculo->value(),
            'id_personal' => $idPersonal->value(),
            'id_estado' => 1,
            'id_caja' => $idCaja->value(),
            'id_caja_diario' => $idCajaDiario->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);

        $model = $this->eloquent->with(
            'tipoComprobante:id,nombre',
            'medioPago:id,nombre',
            'categoria:id,nombre',
            'tipo:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'sede:id,nombre',
            'vehiculo:id,placa',
            'personal:id,nombre,apellido',
            'estado:id,nombre',
            'caja:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->findOrFail($id->value());
        $OModel = new Egreso(
            new Id($model->id , false, 'El id del egreso no tiene el formato correcto'),
            new NumericInteger($model->id_origen),
            new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante),
            new Text($model->serie, false, -1, ''),
            new NumericInteger($model->numero),
            new Id($model->id_egreso_categoria , false, 'El id de la categoria no tiene el formato correcto'),
            new Id($model->id_egreso_tipo , false, 'El id del ingreso no tiene el formato correcto'),
            new Text($model->detalle, false, -1, ''),
            new NumericInteger($model->id_tipo_documento_entidad ),
            new Text($model->numero_documento_entidad, false, -1, ''),
            new Text($model->nombre_entidad, false, -1, ''),
            new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
            new NumericFloat($model->monto),
            new NumericInteger($model->id_medio_pago),
            new Id($model->id_vehiculo , true, 'El id del vehiculo tipo no tiene el formato correcto'),
            new Id($model->id_personal , true, 'El id del personal tipo no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_caja , false, 'El id de la caja  no tiene el formato correcto'),
            new Id($model->id_caja_diario , false, 'El id de la caja diario tipo no tiene el formato correcto'),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
        $OModel->setCategoria(new Text($model->categoria->nombre, false, -1));
        $OModel->setTipo(new Text($model->tipo->nombre, false, -1));
        $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
        $OModel->setSede(new Text($model->sede->nombre, false, -1));
        $OModel->setVehiculo(new Text($model->vehiculo?->placa, true, -1));
        $OModel->setPersonal(new Text($model->personal ? ($model->personal->nombre . ' ' . $model->personal->apellido) : null, true, -1));
        $OModel->setEstado(new Text($model->estado->nombre, false, -1));
        $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1));
        $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

        return $OModel;

    }

    public function delete(
        Id $id
    ): void
    {
        $this->eloquent->where('id',$id->value())->delete();
    }

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): EgresoList
    {
        $models = $this->eloquent->with(
            'tipoComprobante:id,nombre',
            'medioPago:id,nombre',
            'categoria:id,nombre',
            'tipo:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'sede:id,nombre',
            'vehiculo:id,placa',
            'personal:id,nombre,apellido',
            'estado:id,nombre',
            'caja:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )
//            ->leftJoin('egreso_detalle', 'egreso.id', '=', 'egreso_detalle.id_egreso')
//            ->leftjoin('ce_comprobante_electronico',  'egreso.id', '=', 'ce_comprobante_electronico.id_producto')
//            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->where('id_cliente',$idCliente->value())
            ->whereDate('f_registro','>=', $fechaDesde->value())
            ->whereDate('f_registro','<=', $fechaHasta->value());

        if(!is_null($idVehiculo->value())){
            $models = $models->where('id_vehiculo', $idVehiculo->value());
        }
        if(!is_null($idPersonal->value())){
            $models = $models->where('id_personal', $idPersonal->value());
        }

        $models = $models->orderBy('f_registro', 'desc')
            ->get();


        $collection = new EgresoList();

        foreach ( $models as $model ){

            $OModel = new Egreso(
                new Id($model->id , false, 'El id del egreso no tiene el formato correcto'),
                new NumericInteger($model->id_origen),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_comprobante),
                new Text($model->serie, false, -1, ''),
                new NumericInteger($model->numero),
                new Id($model->id_egreso_categoria , false, 'El id de la categoria no tiene el formato correcto'),
                new Id($model->id_egreso_tipo , false, 'El id del ingreso no tiene el formato correcto'),
                new Text($model->detalle, false, -1, ''),
                new NumericInteger($model->id_tipo_documento_entidad ),
                new Text($model->numero_documento_entidad, false, -1, ''),
                new Text($model->nombre_entidad, false, -1, ''),
                new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
                new NumericFloat($model->monto),
                new NumericInteger($model->id_medio_pago),
                new Id($model->id_vehiculo , true, 'El id del vehiculo tipo no tiene el formato correcto'),
                new Id($model->id_personal , true, 'El id del personal tipo no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_caja , false, 'El id de la caja  no tiene el formato correcto'),
                new Id($model->id_caja_diario , false, 'El id de la caja diario tipo no tiene el formato correcto'),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );
            $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
            $OModel->setCategoria(new Text($model->categoria->nombre, false, -1));
            $OModel->setTipo(new Text($model->tipo->nombre, false, -1));
            $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
            $OModel->setSede(new Text($model->sede->nombre, false, -1));
            $OModel->setVehiculo(new Text($model->vehiculo?->placa, true, -1));
            $OModel->setPersonal(new Text($model->personal ? ($model->personal->nombre . ' ' . $model->personal->apellido) : null, true, -1));
            $OModel->setEstado(new Text($model->estado->nombre, false, -1));
            $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1));
            $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteDespachoByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): EgresoList
    {
        $models = $this->eloquent->with(
            'tipoComprobante:id,nombre',
            'categoria:id,nombre',
            'tipo:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'sede:id,nombre',
            'vehiculo:id,placa',
            'personal:id,nombre,apellido',
            'estado:id,nombre',
            'caja:id,nombre',
            'medioPago:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )
//            ->leftjoin('ce_comprobante_electronico',  'egreso.id', '=', 'ce_comprobante_electronico.id_producto')
//            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->where('id_cliente',$idCliente->value())
            ->where('id_usu_registro',$idUsuario->value())
            ->whereDate('f_registro',$fecha->value())
            ->orderBy('f_registro', 'desc')
            ->get();

        $collection = new EgresoList();

        foreach ( $models as $model ){

            $OModel = new Egreso(
                new Id($model->id , false, 'El id del egreso no tiene el formato correcto'),
                new NumericInteger($model->id_origen),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_comprobante),
                new Text($model->serie, false, -1, ''),
                new NumericInteger($model->numero),
                new Id($model->id_egreso_categoria , false, 'El id de la categoria no tiene el formato correcto'),
                new Id($model->id_egreso_tipo , false, 'El id del ingreso no tiene el formato correcto'),
                new Text($model->detalle, false, -1, ''),
                new NumericInteger($model->id_tipo_documento_entidad ),
                new Text($model->numero_documento_entidad, false, -1, ''),
                new Text($model->nombre_entidad, false, -1, ''),
                new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
                new NumericFloat($model->monto),
                new NumericInteger($model->id_medio_pago),
                new Id($model->id_vehiculo , true, 'El id del vehiculo tipo no tiene el formato correcto'),
                new Id($model->id_personal , true, 'El id del personal tipo no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_caja , false, 'El id de la caja  no tiene el formato correcto'),
                new Id($model->id_caja_diario , false, 'El id de la caja diario tipo no tiene el formato correcto'),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );
            $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
            $OModel->setCategoria(new Text($model->categoria->nombre, false, -1));
            $OModel->setTipo(new Text($model->tipo->nombre, false, -1));
            $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
            $OModel->setSede(new Text($model->sede->nombre, false, -1));
            $OModel->setVehiculo(new Text($model->vehiculo?->placa, true, -1));
            $OModel->setPersonal(new Text($model->personal ? ($model->personal->nombre . ' ' . $model->personal->apellido) : null, true, -1));
            $OModel->setEstado(new Text($model->estado->nombre, false, -1));
            $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
            $OModel->setMedioPago(new Text($model->medioPago?->nombre, false, -1));
            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));


            $collection->add($OModel);
        }

        return $collection;
    }

    public function find(
        Id $idEgreso,
    ): Egreso
    {
        $model = $this->eloquent->with(
            'tipoComprobante:id,nombre',
            'categoria:id,nombre',
            'tipo:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'sede:id,nombre',
            'vehiculo:id,placa',
            'personal:id,nombre,apellido',
            'estado:id,nombre',
            'caja:id,nombre',
            'medioPago:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->findOrFail($idEgreso->value());
        $OModel = new Egreso(
            new Id($model->id , false, 'El id del egreso no tiene el formato correcto'),
            new NumericInteger($model->id_origen),
            new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante),
            new Text($model->serie, false, -1, ''),
            new NumericInteger($model->numero),
            new Id($model->id_egreso_categoria , false, 'El id de la categoria no tiene el formato correcto'),
            new Id($model->id_egreso_tipo , false, 'El id del ingreso no tiene el formato correcto'),
            new Text($model->detalle, false, -1, ''),
            new NumericInteger($model->id_tipo_documento_entidad ),
            new Text($model->numero_documento_entidad, false, -1, ''),
            new Text($model->nombre_entidad, false, -1, ''),
            new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
            new NumericFloat($model->monto),
            new NumericInteger($model->id_medio_pago),
            new Id($model->id_vehiculo , true, 'El id del vehiculo tipo no tiene el formato correcto'),
            new Id($model->id_personal , true, 'El id del personal tipo no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_caja , false, 'El id de la caja  no tiene el formato correcto'),
            new Id($model->id_caja_diario , false, 'El id de la caja diario tipo no tiene el formato correcto'),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
        $OModel->setCategoria(new Text($model->categoria->nombre, false, -1));
        $OModel->setTipo(new Text($model->tipo->nombre, false, -1));
        $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
        $OModel->setSede(new Text($model->sede->nombre, false, -1));
        $OModel->setVehiculo(new Text($model->vehiculo?->placa, true, -1));
        $OModel->setPersonal(new Text($model->personal ? ($model->personal->nombre . ' ' . $model->personal->apellido) : null, true, -1));
        $OModel->setEstado(new Text($model->estado->nombre, false, -1));
        $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
        $OModel->setMedioPago(new Text($model->medioPago?->nombre, false, -1));
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

        return $OModel;
    }


    public function findPdf(
        Id $idEgreso,
    ): Egreso
    {
        $model = $this->eloquent->with(
            'tipoComprobante:id,nombre',
            'categoria:id,nombre',
            'tipo:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'sede:id,nombre',
            'vehiculo:id,placa',
            'personal:id,nombre,apellido',
            'estado:id,nombre',
            'caja:id,nombre',
            'medioPago:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->findOrFail($idEgreso->value());
        $OModel = new Egreso(
            new Id($model->id , false, 'El id del egreso no tiene el formato correcto'),
            new NumericInteger($model->id_origen),
            new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante),
            new Text($model->serie, false, -1, ''),
            new NumericInteger($model->numero),
            new Id($model->id_egreso_categoria , false, 'El id de la categoria no tiene el formato correcto'),
            new Id($model->id_egreso_tipo , false, 'El id del ingreso no tiene el formato correcto'),
            new Text($model->detalle, false, -1, ''),
            new NumericInteger($model->id_tipo_documento_entidad ),
            new Text($model->numero_documento_entidad, false, -1, ''),
            new Text($model->nombre_entidad, false, -1, ''),
            new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
            new NumericFloat($model->monto),
            new NumericInteger($model->id_medio_pago),
            new Id($model->id_vehiculo , true, 'El id del vehiculo tipo no tiene el formato correcto'),
            new Id($model->id_personal , true, 'El id del personal tipo no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_caja , false, 'El id de la caja  no tiene el formato correcto'),
            new Id($model->id_caja_diario , false, 'El id de la caja diario tipo no tiene el formato correcto'),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setTipoComprobante(new Text($model->tipoComprobante->nombre, false, -1));
        $OModel->setCategoria(new Text($model->categoria->nombre, false, -1));
        $OModel->setTipo(new Text($model->tipo->nombre, false, -1));
        $OModel->setTipoDocumentoEntidad(new Text($model->tipoDocumento->nombre_corto, false, -1));
        $OModel->setSede(new Text($model->sede->nombre, false, -1));
        $OModel->setVehiculo(new Text($model->vehiculo?->placa, true, -1));
        $OModel->setPersonal(new Text($model->personal ? ($model->personal->nombre . ' ' . $model->personal->apellido) : null, true, -1));
        $OModel->setEstado(new Text($model->estado->nombre, false, -1));
        $OModel->setCaja(new Text($model->caja?->nombre, false, -1));
        $OModel->setMedioPago(new Text($model->medioPago?->nombre, false, -1));
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

        return $OModel;
    }



    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): EgresoGroupTipoFechaShortList
    {
        $collection = new EgresoGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'egreso.id_cliente',
                'egreso_detalle.id_egreso_tipo',
                'egreso_tipo.nombre as tipo',
                DB::raw('SUM(egreso_detalle.importe) as total'),
                DB::raw('DATE(egreso_detalle.fecha) as fecha')
            )
            ->join('egreso_detalle', 'egreso.id','=','egreso_detalle.id_egreso')
            ->join('egreso_tipo', 'egreso_detalle.id_egreso_tipo','=','egreso_tipo.id')
            ->where('egreso.id_cliente',$idCliente->value())
            ->whereDate('egreso_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('egreso_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('egreso.id_cliente', 'egreso_detalle.fecha', 'egreso_detalle.id_egreso_tipo', 'egreso_tipo.nombre')
            ->get();


        foreach ( $models as $model ){

            $OModel = new EgresoGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del egreso no tiene el formato correcto'),
                new Id($model->id_egreso_tipo , false, 'El id del cliente no tiene el formato correcto'),
                new Text($model->tipo , true, -1, ''),
                new NumericFloat($model->total ),
                new DateFormat($model->fecha , false, 'El id de la caja  no tiene el formato correcto')
            );

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): EgresoGroupTipoFechaShortList
    {
        $collection = new EgresoGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'egreso.id_cliente',
                'egreso.id_vehiculo',
                'egreso_detalle.id_egreso_tipo',
                'egreso_tipo.nombre as tipo',
                DB::raw('SUM(egreso_detalle.importe) as total'),
                DB::raw('DATE(egreso_detalle.fecha) as fecha')
            )
            ->join('egreso_detalle', 'egreso.id','=','egreso_detalle.id_egreso')
            ->join('egreso_tipo', 'egreso_detalle.id_egreso_tipo','=','egreso_tipo.id')
            ->where('egreso.id_cliente',$idCliente->value())
            ->whereDate('egreso_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('egreso_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('egreso.id_cliente', 'egreso_detalle.fecha', 'egreso_detalle.id_egreso_tipo', 'egreso_tipo.nombre', 'egreso.id_vehiculo')
            ->get();


        foreach ( $models as $model ){

            $OModel = new EgresoGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del egreso no tiene el formato correcto'),
                new Id($model->id_egreso_tipo , false, 'El id del cliente no tiene el formato correcto'),
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
                'egreso.id_vehiculo',
                'egreso_detalle.id_egreso_tipo',
                'egreso_detalle.detalle',
                'egreso_tipo.nombre as egreso_tipo',
                DB::raw('SUM(egreso_detalle.importe) as total'),
                DB::raw('DATE(egreso_detalle.fecha) as fecha')
            )
            ->join('egreso_detalle', 'egreso.id','=','egreso_detalle.id_egreso')
            ->join('egreso_tipo', 'egreso_detalle.id_egreso_tipo','=','egreso_tipo.id')
            ->where('egreso.id_cliente',$idCliente->value())
            ->whereDate('egreso_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('egreso_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('egreso.id_vehiculo', 'egreso_detalle.id_egreso_tipo', 'egreso_detalle.detalle', 'egreso_tipo.nombre', 'egreso_detalle.fecha')
            ->get();

        foreach ( $models as $model ){

            $OModel = new EgresoLiquidacionRangoFechaVehiculo(
                new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->id_egreso_tipo , false, 'El id del egreso tipo no tiene el formato correcto'),
                new Text($model->egreso_tipo , false, -1, ''),
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
            'id_estado' => EnumEstadoEgreso::Anulado->value,
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

}
