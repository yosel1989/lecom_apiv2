<?php

declare(strict_types=1);

namespace Src\V2\Cronograma\Infrastructure\Repositories;

use App\Models\V2\Ruta;
use App\Models\V2\Cronograma as EloquentModelCronograma;
use App\Models\V2\Sede;
use App\Models\V2\TipoRuta;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Cronograma\Domain\Contracts\CronogramaRepositoryContract;
use Src\V2\Cronograma\Domain\Cronograma;
use Src\V2\Cronograma\Domain\CronogramaGroupTipoFechaShort;
use Src\V2\Cronograma\Domain\CronogramaGroupTipoFechaShortList;
use Src\V2\Cronograma\Domain\CronogramaLiquidacionRangoFechaVehiculo;
use Src\V2\Cronograma\Domain\CronogramaList;

final class EloquentCronogramaRepository implements CronogramaRepositoryContract
{
    private EloquentModelCronograma $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelCronograma;
    }

    public function create(
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoRuta,
        Id $idRuta,
        DateFormat $fecha,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        // Validar que no se repita
        $Cronograma = $this->eloquent->where('id_cliente', $idCliente->value())->whereDate('fecha', $fecha->value())->where('id_sede', $idSede->value())->where('id_ruta', $idRuta->value())->where('id_estado', 1);
        if( $Cronograma->count() > 0 ){
            throw new InvalidArgumentException( 'La Cronograma ya se encuentra registrada en el sistema.' );
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

        // Validar tipo ruta
        $TipoRuta = TipoRuta::where('id',$idTipoRuta->value());
        if( $TipoRuta->count() === 0 ){
            throw new InvalidArgumentException( 'El tipo de ruta no se encuentra registrado en el sistema en el sistema' );
        }

        // Validar ruta
        $Ruta = Ruta::where('id_estado', 1)->where('id',$idRuta->value());
        if( $Ruta->count() === 0 ){
            throw new InvalidArgumentException( 'La ruta no se encuentra registrado en el sistema en el sistema' );
        }

        // Validar cliente
        $Cliente = \App\Models\V2\Cliente::where('id', $idCliente->value())->where('idEstado',1)->where('idEliminado',0);
        if( $Cliente->count() === 0 ){
            throw new InvalidArgumentException( 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.' );
        }

        $this->eloquent->create([
            'id_cliente' => $idCliente->value(),
            'id_sede' => $idSede->value(),
            'id_tipo_ruta' => $idTipoRuta->value(),
            'id_ruta' =>  $idRuta->value(),
            'fecha' =>  $fecha->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }

    public function delete(
        Id $id
    ): void
    {
        $this->eloquent->where('id',$id->value())->delete();
    }

    public function collectionByCliente(Id $idCliente): CronogramaList
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


        $collection = new CronogramaList();

        foreach ( $models as $model ){

            $OModel = new Cronograma(
                new Id($model->id , false, 'El id del Cronograma no tiene el formato correcto'),
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

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): CronogramaList
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
//            ->leftJoin('Cronograma_detalle', 'Cronograma.id', '=', 'Cronograma_detalle.id_Cronograma')
//            ->leftjoin('ce_comprobante_electronico',  'Cronograma.id', '=', 'ce_comprobante_electronico.id_producto')
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


        $collection = new CronogramaList();

        foreach ( $models as $model ){

            $OModel = new Cronograma(
                new Id($model->id , false, 'El id del Cronograma no tiene el formato correcto'),
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

    public function reporteDespachoByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): CronogramaList
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
//            ->leftjoin('ce_comprobante_electronico',  'Cronograma.id', '=', 'ce_comprobante_electronico.id_producto')
//            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->where('id_cliente',$idCliente->value())
            ->where('id_usu_registro',$idUsuario->value())
            ->whereDate('f_registro',$fecha->value())
            ->orderBy('f_registro', 'desc')
            ->get();

        $collection = new CronogramaList();

        foreach ( $models as $model ){

            $OModel = new Cronograma(
                new Id($model->id , false, 'El id del Cronograma no tiene el formato correcto'),
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
        Id $idCronograma,
    ): Cronograma
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->findOrFail($idCronograma->value());
        $OModel = new Cronograma(
            new Id($model->id , false, 'El id del Cronograma no tiene el formato correcto'),
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
        Id $idCronograma,
    ): Cronograma
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
        )->findOrFail($idCronograma->value());
        $OModel = new Cronograma(
            new Id($model->id , false, 'El id del Cronograma no tiene el formato correcto'),
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



    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CronogramaGroupTipoFechaShortList
    {
        $collection = new CronogramaGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'Cronograma.id_cliente',
                'Cronograma_detalle.id_Cronograma_tipo',
                'Cronograma_tipo.nombre as tipo',
                DB::raw('SUM(Cronograma_detalle.importe) as total'),
                DB::raw('DATE(Cronograma_detalle.fecha) as fecha')
            )
            ->join('Cronograma_detalle', 'Cronograma.id','=','Cronograma_detalle.id_Cronograma')
            ->join('Cronograma_tipo', 'Cronograma_detalle.id_Cronograma_tipo','=','Cronograma_tipo.id')
            ->where('Cronograma.id_cliente',$idCliente->value())
            ->whereDate('Cronograma_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('Cronograma_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('Cronograma.id_cliente', 'Cronograma_detalle.fecha', 'Cronograma_detalle.id_Cronograma_tipo', 'Cronograma_tipo.nombre')
            ->get();


        foreach ( $models as $model ){

            $OModel = new CronogramaGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del Cronograma no tiene el formato correcto'),
                new Id($model->id_Cronograma_tipo , false, 'El id del cliente no tiene el formato correcto'),
                new Text($model->tipo , true, -1, ''),
                new NumericFloat($model->total ),
                new DateFormat($model->fecha , false, 'El id de la caja  no tiene el formato correcto')
            );

            $collection->add($OModel);
        }

        return $collection;
    }

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CronogramaGroupTipoFechaShortList
    {
        $collection = new CronogramaGroupTipoFechaShortList();

        $models = $this->eloquent
            ->select(
                'Cronograma.id_cliente',
                'Cronograma.id_vehiculo',
                'Cronograma_detalle.id_Cronograma_tipo',
                'Cronograma_tipo.nombre as tipo',
                DB::raw('SUM(Cronograma_detalle.importe) as total'),
                DB::raw('DATE(Cronograma_detalle.fecha) as fecha')
            )
            ->join('Cronograma_detalle', 'Cronograma.id','=','Cronograma_detalle.id_Cronograma')
            ->join('Cronograma_tipo', 'Cronograma_detalle.id_Cronograma_tipo','=','Cronograma_tipo.id')
            ->where('Cronograma.id_cliente',$idCliente->value())
            ->whereDate('Cronograma_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('Cronograma_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('Cronograma.id_cliente', 'Cronograma_detalle.fecha', 'Cronograma_detalle.id_Cronograma_tipo', 'Cronograma_tipo.nombre', 'Cronograma.id_vehiculo')
            ->get();


        foreach ( $models as $model ){

            $OModel = new CronogramaGroupTipoFechaShort(
                new Id($model->id_cliente , false, 'El id del Cronograma no tiene el formato correcto'),
                new Id($model->id_Cronograma_tipo , false, 'El id del cliente no tiene el formato correcto'),
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
                'Cronograma.id_vehiculo',
                'Cronograma_detalle.id_Cronograma_tipo',
                'Cronograma_detalle.detalle',
                'Cronograma_tipo.nombre as Cronograma_tipo',
                DB::raw('SUM(Cronograma_detalle.importe) as total'),
                DB::raw('DATE(Cronograma_detalle.fecha) as fecha')
            )
            ->join('Cronograma_detalle', 'Cronograma.id','=','Cronograma_detalle.id_Cronograma')
            ->join('Cronograma_tipo', 'Cronograma_detalle.id_Cronograma_tipo','=','Cronograma_tipo.id')
            ->where('Cronograma.id_cliente',$idCliente->value())
            ->whereDate('Cronograma_detalle.fecha','>=', $fechaDesde->value())
            ->whereDate('Cronograma_detalle.fecha','<=', $fechaHasta->value())
            ->groupBy('Cronograma.id_vehiculo', 'Cronograma_detalle.id_Cronograma_tipo', 'Cronograma_detalle.detalle', 'Cronograma_tipo.nombre', 'Cronograma_detalle.fecha')
            ->get();

        foreach ( $models as $model ){

            $OModel = new CronogramaLiquidacionRangoFechaVehiculo(
                new Id($model->id_vehiculo , false, 'El id del vehiculo no tiene el formato correcto'),
                new Id($model->id_Cronograma_tipo , false, 'El id del Cronograma tipo no tiene el formato correcto'),
                new Text($model->Cronograma_tipo , false, -1, ''),
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
            'id_estado' => EnumEstadoCronograma::Anulado->value,
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

}
