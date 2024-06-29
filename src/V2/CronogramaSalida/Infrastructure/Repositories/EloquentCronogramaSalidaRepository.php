<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Infrastructure\Repositories;

use App\Models\V2\BoletoInterprovincialOficial as EloquentModelBoletoInterprovincial;
use App\Models\V2\Cliente;
use App\Models\V2\Cronograma;
use App\Models\V2\CronogramaSalida as EloquentModelCronogramaSalida;
use App\Models\V2\Vehiculo;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\TimeFormat;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;
use Src\V2\CronogramaSalida\Domain\CronogramaSalida;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaGroupTipoFechaShort;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaGroupTipoFechaShortList;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaLiquidacionRangoFechaVehiculo;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaShort;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaShortList;

final class EloquentCronogramaSalidaRepository implements CronogramaSalidaRepositoryContract
{
    private EloquentModelCronogramaSalida $eloquent;
    private EloquentModelBoletoInterprovincial $eloquentModelBoletoInterprovincial;

    public function __construct()
    {
        $this->eloquent = new EloquentModelCronogramaSalida;
        $this->eloquentModelBoletoInterprovincial = new EloquentModelBoletoInterprovincial;
    }

    public function create(
        Id $idCliente,
        Id $idCronograma,
        Id $idVehiculo,
        DateFormat $fecha,
        TimeFormat $hora,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        // Validar que no se repita
        $CronogramaSalida = $this->eloquent->where('id_cliente', $idCliente->value())
            ->whereDate('fecha', $fecha->value())
            ->whereTime('hora', $hora->value())
            ->where('id_cronograma', $idCronograma->value())
            ->where('id_estado', 1);
        if( $CronogramaSalida->count() > 0 ){
            throw new InvalidArgumentException( 'La salida ya se encuentra registrada en el sistema.' );
        }

        // Validar sede
        $Cronograma = Cronograma::where('id', $idCronograma->value())->where('id_estado', 1)->where('id_eliminado',0)->where('id_cliente',$idCliente->value());
        if( $Cronograma->count() === 0 ){
            throw new InvalidArgumentException( 'El cronograma no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar vehiculo
        $Vehiculo = Vehiculo::where('id',$idVehiculo->value());
        if( $Vehiculo->count() === 0 ){
            throw new InvalidArgumentException( 'El vehiculo no se encuentra registrado en el sistema en el sistema' );
        }

        // Validar cliente
        $Cliente = \App\Models\V2\Cliente::where('id', $idCliente->value())->where('idEstado',1)->where('idEliminado',0);
        if( $Cliente->count() === 0 ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        $this->eloquent->create([
            'id_cliente' => $idCliente->value(),
            'id_cronograma' => $idCronograma->value(),
            'id_vehiculo' => $idVehiculo->value(),
            'fecha' =>  $fecha->value(),
            'hora' =>  $hora->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Id $idCliente,
        Id $idCronograma,
        Id $idVehiculo,
        DateFormat $fecha,
        TimeFormat $hora,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        // Validar que no se repita
        $CronogramaSalida = $this->eloquent->where('id_cliente', $idCliente->value())->whereDate('fecha', $fecha->value())->whereTime('hora', $hora->value())->where('id_cronograma', $idCronograma->value())->where('id_estado', 1)->where('id', '<>', $id->value());
        if( $CronogramaSalida->count() > 0 ){
            throw new InvalidArgumentException( 'La salida ya se encuentra registrada en el sistema.' );
        }

        // Validar cronograma
        $Cronograma = Cronograma::where('id', $idCronograma->value())->where('id_estado', 1)->where('id_eliminado',0)->where('id_cliente',$idCliente->value());
        if( $Cronograma->count() === 0 ){
            throw new InvalidArgumentException( 'El cronograma no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        // Validar vehiculo
        $Vehiculo = Vehiculo::where('id',$idVehiculo->value());
        if( $Vehiculo->count() === 0 ){
            throw new InvalidArgumentException( 'El vehiculo no se encuentra registrado en el sistema en el sistema' );
        }

        // Validar cliente
        $Cliente = \App\Models\V2\Cliente::where('id', $idCliente->value())->where('idEstado',1)->where('idEliminado',0);
        if( $Cliente->count() === 0 ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        $this->eloquent->findOrFail($id->value())->update([
            'id_vehiculo' => $idVehiculo->value(),
            'hora' =>  $hora->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idCronogramaSalida,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void{
        $this->eloquent->findOrFail($idCronogramaSalida->value())->update([
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function delete(
        Id $id
    ): void
    {
        $this->eloquent->where('id',$id->value())->delete();
    }

    public function collectionByCliente(Id $idCliente): CronogramaSalidaList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoRuta:id,nombre',
            'sede:id,nombre',
            'ruta:id,nombre',
        )
            ->where('id_cliente',$idCliente->value())
            ->orderBy('fecha', 'DESC')
            ->get();


        $collection = new CronogramaSalidaList();

        foreach ( $models as $model ){

            $OModel = new CronogramaSalida(
                new Id($model->id , false, 'El id del CronogramaSalida no tiene el formato correcto'),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_ruta),
                new Id($model->id_ruta , false, 'El id de la ruta no tiene el formato correcto'),
                new DateFormat($model->fecha, false),
                new NumericInteger($model->id_estado),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );
            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text($model->sede->nombre, false, -1));
            $OModel->setTipoRuta(new Text($model->tipoRuta->nombre, false, -1));
            $OModel->setRuta(new Text($model->ruta->nombre, false, -1));

            $collection->add($OModel);
        }

        return $collection;
    }


    public function collectionByCronograma(Id $idCronograma): CronogramaSalidaList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'vehiculo:id,placa'
        )
            ->where('id_cronograma',$idCronograma->value())
            ->orderBy('fecha', 'DESC')
            ->orderBy('hora', 'DESC')
            ->get();


        $collection = new CronogramaSalidaList();

        foreach ( $models as $model ){

            $OModel = new CronogramaSalida(
                new Id($model->id , false, 'El id del CronogramaSalida no tiene el formato correcto'),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_cronograma , false, 'El id de cronograma no tiene el formato correcto'),
                new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
                new DateFormat($model->fecha, false),
                new TimeFormat($model->hora, false),
                new NumericInteger($model->id_estado),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );
            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setVehiculo(new Text($model->vehiculo->placa, false, -1));

            $collection->add($OModel);
        }

        return $collection;
    }

    public function collectionByRuta(Id $idRuta): CronogramaSalidaList
    {
//        dd($idRuta->value());
        $today = new \DateTime('now');
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'vehiculo:id,placa'
        )
            ->select('cronograma_salida.*')
            ->join('cronograma','cronograma_salida.id_cronograma','=', 'cronograma.id')
            ->where('cronograma.id_ruta',$idRuta->value())
            ->where('cronograma_salida.id_estado',1)
            ->whereDate('cronograma_salida.fecha',$today->format('Y-m-d'))
            ->orderBy('cronograma_salida.fecha', 'DESC')
            ->orderBy('cronograma_salida.hora', 'ASC')
            ->get();


        $collection = new CronogramaSalidaList();

        foreach ( $models as $model ){

            $OModel = new CronogramaSalida(
                new Id($model->id , false, 'El id del CronogramaSalida no tiene el formato correcto'),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_cronograma , false, 'El id de cronograma no tiene el formato correcto'),
                new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
                new DateFormat($model->fecha, false),
                new TimeFormat($model->hora, false),
                new NumericInteger($model->id_estado),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );
            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setVehiculo(new Text($model->vehiculo->placa, false, -1));

            $collection->add($OModel);
        }

        return $collection;
    }



    public function listByVehiculoRutaFecha(Id $idVehiculo, Id $idRuta, DateFormat $fecha): CronogramaSalidaShortList
    {

        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'vehiculo:id,placa'
        )
            ->select('cronograma_salida.*')
            ->join('cronograma','cronograma_salida.id_cronograma','=', 'cronograma.id')
            ->where('cronograma.id_ruta',$idRuta->value())
            ->where('cronograma_salida.id_vehiculo',$idVehiculo->value())
            ->where('cronograma_salida.id_estado',1)
            ->whereDate('cronograma_salida.fecha',$fecha->value())
            ->orderBy('cronograma_salida.fecha', 'DESC')
            ->orderBy('cronograma_salida.hora', 'ASC')
            ->get();


        $collection = new CronogramaSalidaShortList();

        foreach ( $models as $model ){

            $OModel = new CronogramaSalidaShort(
                new Id($model->id , false, 'El id del CronogramaSalida no tiene el formato correcto'),
                new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
                new DateFormat($model->fecha, false),
                new TimeFormat($model->hora, false),
                new NumericInteger($model->id_estado),
                new NumericInteger($model->id_eliminado->value)
            );
            $OModel->setVehiculo(new Text($model->vehiculo->placa, false, -1));

            $collection->add($OModel);
        }

        return $collection;
    }


    public function asientosDisponibles(Id $idCliente, Id $idCronogramaSalida): NumericInteger{
        $OCliente = Cliente::findOrFail($idCliente->value());
        $OCronogramaSalida = \App\Models\V2\CronogramaSalida::findOrFail($idCronogramaSalida->value());
        $OVehiculo = \App\Models\V2\Vehiculo::findOrFail($OCronogramaSalida->id_vehiculo);
        $this->eloquentModelBoletoInterprovincial->setDynamicTableName('boleto_interprovincial_cliente_' . $OCliente->codigo);

        $result = $this->eloquent
            ->selectRaw('COUNT(*) as vendidos')
            ->join('boleto_interprovincial_cliente_' . $OCliente->codigo, 'cronograma_salida.id','=','boleto_interprovincial_cliente_' . $OCliente->codigo. '.id_cronograma_salida')
            ->where('cronograma_salida.id' , $idCronogramaSalida->value())
            ->where('boleto_interprovincial_cliente_' . $OCliente->codigo . '.id_estado', 1)
            ->where('boleto_interprovincial_cliente_' . $OCliente->codigo . '.id_vehiculo', $OVehiculo->id)
            ->get();

//        dd($result->first()->vendidos);

        return new NumericInteger(($OVehiculo->num_asientos - $result->first()->vendidos) ? $OVehiculo->num_asientos - $result->first()->vendidos : 0);

    }


    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): CronogramaSalidaList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoComprobante:id,nombre',
            'sede:id,nombre',
            'caja:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'personal:id,nombre,apellido',
            'vehiculo:id,placa',
            'estado:id,nombre',
        )
//            ->leftJoin('CronogramaSalida_detalle', 'CronogramaSalida.id', '=', 'CronogramaSalida_detalle.id_CronogramaSalida')
//            ->leftjoin('ce_comprobante_electronico',  'CronogramaSalida.id', '=', 'ce_comprobante_electronico.id_producto')
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


        $collection = new CronogramaSalidaList();

        foreach ( $models as $model ){

            $OModel = new CronogramaSalida(
                new Id($model->id , false, 'El id del CronogramaSalida no tiene el formato correcto'),
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

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteDespachoByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): CronogramaSalidaList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoComprobante:id,nombre',
            'sede:id,nombre',
            'caja:id,nombre',
            'estado:id,nombre',
            'tipoDocumento:id,nombre_corto',
            'vehiculo:id,placa',
            'personal:id,nombre,apellido',
        )
//            ->leftjoin('ce_comprobante_electronico',  'CronogramaSalida.id', '=', 'ce_comprobante_electronico.id_producto')
//            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->where('id_cliente',$idCliente->value())
            ->where('id_usu_registro',$idUsuario->value())
            ->whereDate('f_registro',$fecha->value())
            ->orderBy('f_registro', 'desc')
            ->get();

        $collection = new CronogramaSalidaList();

        foreach ( $models as $model ){

            $OModel = new CronogramaSalida(
                new Id($model->id , false, 'El id del CronogramaSalida no tiene el formato correcto'),
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


            $collection->add($OModel);
        }

        return $collection;
    }

    public function find(
        Id $idCronogramaSalida,
    ): CronogramaSalida
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'vehiculo:id,placa'
        )->findOrFail($idCronogramaSalida->value());
        $OModel = new CronogramaSalida(
            new Id($model->id , false, 'El id del CronogramaSalida no tiene el formato correcto'),
            new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_cronograma , false, 'El id de cronograma no tiene el formato correcto'),
            new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
            new DateFormat($model->fecha, false),
            new TimeFormat($model->hora, false),
            new NumericInteger($model->id_estado),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setVehiculo(new Text($model->vehiculo->placa, false, -1));

        return $OModel;
    }


    public function findPdf(
        Id $idCronogramaSalida,
    ): CronogramaSalida
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
        )->findOrFail($idCronogramaSalida->value());
        $OModel = new CronogramaSalida(
            new Id($model->id , false, 'El id del CronogramaSalida no tiene el formato correcto'),
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



    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CronogramaSalidaGroupTipoFechaShortList
    {
        $collection = new CronogramaSalidaGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'CronogramaSalida.id_cliente',
                'CronogramaSalida_detalle.id_CronogramaSalida_tipo',
                'CronogramaSalida_tipo.nombre as tipo',
                DB::raw('SUM(CronogramaSalida_detalle.importe) as total'),
                DB::raw('DATE(CronogramaSalida_detalle.fecha) as fecha')
            )
            ->join('CronogramaSalida_detalle', 'CronogramaSalida.id','=','CronogramaSalida_detalle.id_CronogramaSalida')
            ->join('CronogramaSalida_tipo', 'CronogramaSalida_detalle.id_CronogramaSalida_tipo','=','CronogramaSalida_tipo.id')
            ->where('CronogramaSalida.id_cliente',$idCliente->value())
            ->whereDate('CronogramaSalida_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('CronogramaSalida_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('CronogramaSalida.id_cliente', 'CronogramaSalida_detalle.fecha', 'CronogramaSalida_detalle.id_CronogramaSalida_tipo', 'CronogramaSalida_tipo.nombre')
            ->get();


        foreach ( $models as $model ){

            $OModel = new CronogramaSalidaGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del CronogramaSalida no tiene el formato correcto'),
                new Id($model->id_CronogramaSalida_tipo , false, 'El id del cliente no tiene el formato correcto'),
                new Text($model->tipo , true, -1, ''),
                new NumericFloat($model->total ),
                new DateFormat($model->fecha , false, 'El id de la caja  no tiene el formato correcto')
            );

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CronogramaSalidaGroupTipoFechaShortList
    {
        $collection = new CronogramaSalidaGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'CronogramaSalida.id_cliente',
                'CronogramaSalida.id_vehiculo',
                'CronogramaSalida_detalle.id_CronogramaSalida_tipo',
                'CronogramaSalida_tipo.nombre as tipo',
                DB::raw('SUM(CronogramaSalida_detalle.importe) as total'),
                DB::raw('DATE(CronogramaSalida_detalle.fecha) as fecha')
            )
            ->join('CronogramaSalida_detalle', 'CronogramaSalida.id','=','CronogramaSalida_detalle.id_CronogramaSalida')
            ->join('CronogramaSalida_tipo', 'CronogramaSalida_detalle.id_CronogramaSalida_tipo','=','CronogramaSalida_tipo.id')
            ->where('CronogramaSalida.id_cliente',$idCliente->value())
            ->whereDate('CronogramaSalida_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('CronogramaSalida_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('CronogramaSalida.id_cliente', 'CronogramaSalida_detalle.fecha', 'CronogramaSalida_detalle.id_CronogramaSalida_tipo', 'CronogramaSalida_tipo.nombre', 'CronogramaSalida.id_vehiculo')
            ->get();


        foreach ( $models as $model ){

            $OModel = new CronogramaSalidaGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del CronogramaSalida no tiene el formato correcto'),
                new Id($model->id_CronogramaSalida_tipo , false, 'El id del cliente no tiene el formato correcto'),
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
                'CronogramaSalida.id_vehiculo',
                'CronogramaSalida_detalle.id_CronogramaSalida_tipo',
                'CronogramaSalida_detalle.detalle',
                'CronogramaSalida_tipo.nombre as CronogramaSalida_tipo',
                DB::raw('SUM(CronogramaSalida_detalle.importe) as total'),
                DB::raw('DATE(CronogramaSalida_detalle.fecha) as fecha')
            )
            ->join('CronogramaSalida_detalle', 'CronogramaSalida.id','=','CronogramaSalida_detalle.id_CronogramaSalida')
            ->join('CronogramaSalida_tipo', 'CronogramaSalida_detalle.id_CronogramaSalida_tipo','=','CronogramaSalida_tipo.id')
            ->where('CronogramaSalida.id_cliente',$idCliente->value())
            ->whereDate('CronogramaSalida_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('CronogramaSalida_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('CronogramaSalida.id_vehiculo', 'CronogramaSalida_detalle.id_CronogramaSalida_tipo', 'CronogramaSalida_detalle.detalle', 'CronogramaSalida_tipo.nombre', 'CronogramaSalida_detalle.fecha')
            ->get();

        foreach ( $models as $model ){

            $OModel = new CronogramaSalidaLiquidacionRangoFechaVehiculo(
                new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->id_CronogramaSalida_tipo , false, 'El id del CronogramaSalida tipo no tiene el formato correcto'),
                new Text($model->CronogramaSalida_tipo , false, -1, ''),
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
            'id_estado' => EnumEstadoCronogramaSalida::Anulado->value,
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

}
