<?php

declare(strict_types=1);

namespace Src\V2\EgresoDetalle\Infrastructure\Repositories;

use App\Enums\EnumEstadoEgresoDetalle;
use App\Models\V2\EgresoDetalle as EloquentModelEgresoDetalle;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoDetalle\Domain\Contracts\EgresoDetalleRepositoryContract;
use Src\V2\EgresoDetalle\Domain\EgresoDetalle;
use Src\V2\EgresoDetalle\Domain\EgresoDetalleList;

final class EloquentEgresoDetalleRepository implements EgresoDetalleRepositoryContract
{
    private EloquentModelEgresoDetalle $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelEgresoDetalle;
    }

    public function collectionByCliente(Id $idCliente, Id $idEgreso): EgresoDetalleList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'egresoTipo:id,nombre',
            'medioPago:id,nombre',
        )
            ->where('id_cliente',$idCliente->value())
            ->where('id_egreso',$idEgreso->value())
            ->orderBy('f_registro', 'desc')
            ->get();

        $collection = new EgresoDetalleList();

        foreach ( $models as $model ){

            $OModel = new EgresoDetalle(
                new Id($model->id , false, 'El id  no tiene el formato correcto'),
                new Id($model->id_egreso , false, 'El id de la egreso no tiene el formato correcto'),
                new Id($model->id_cliente , false, 'El id de la cliente no tiene el formato correcto'),
                new Id($model->id_egreso_tipo , false, 'El id del egreso tipo no tiene el formato correcto'),
                new Text($model->detalle , true, -1, ''),
                new DateFormat($model->fecha, false, 'La fecha no tiene el formato correcto'),
                new NumericFloat($model->importe),
                new NumericInteger($model->id_medio_pago),
                new Text($model->numero_documento , true, -1, ''),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
                new Id($model->id_liquidacion, true, 'El id de la liquidacion no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setEgresoTipo(new Text($model->egresoTipo->nombre, false, -1, ''));
            $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1, ''));

            $collection->add($OModel);
        }

        return $collection;
    }

    public function create(
        Id $id,
        Id $idEgreso,
        Id $idCliente,
        Id $idEgresoTipo,
        Text $detalle,
        DateFormat $fecha,
        NumericFloat $importe,
        NumericInteger $idMedioPago,
        Text $numeroDocumento,
        Id $idUsuarioRegistro
    ): EgresoDetalle
    {

        if($importe->value() === 0){
            throw new \HttpInvalidParamException('El importe debe ser mayor a 0');
        }

        $this->eloquent->create([
            'id' => $id->value(),
            'id_egreso' => $idEgreso->value(),
            'id_cliente' => $idCliente->value(),
            'id_egreso_tipo' => $idEgresoTipo->value(),
            'detalle' => $detalle->value(),
            'fecha' => $fecha->value(),
            'importe' => $importe->value(),
            'id_medio_pago' => $idMedioPago->value(),
            'numero_documento' => $numeroDocumento->value(),
            'id_estado' => 1,
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);


        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'egresoTipo:id,nombre',
            'medioPago:id,nombre',
        )
            ->findOrFail($id->value());

        $OModel = new EgresoDetalle(
            new Id($model->id , false, 'El id  no tiene el formato correcto'),
            new Id($model->id_egreso , false, 'El id de la egreso no tiene el formato correcto'),
            new Id($model->id_cliente , false, 'El id de la cliente no tiene el formato correcto'),
            new Id($model->id_egreso_tipo , false, 'El id del egreso tipo no tiene el formato correcto'),
            new Text($model->detalle , true, -1, ''),
            new DateFormat($model->fecha, false, 'La fecha no tiene el formato correcto'),
            new NumericFloat($model->importe),
            new NumericInteger($model->id_medio_pago),
            new Text($model->numero_documento , true, -1, ''),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            new Id($model->id_liquidacion, true, 'El id de la liquidacion no tiene el formato correcto'),
        );

        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setEgresoTipo(new Text($model->egresoTipo->nombre, false, -1, ''));
        $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1, ''));

        return $OModel;
    }

    public function deleteByEgreso(
        Id $idEgreso
    ): void
    {
        $this->eloquent->where('id_egreso',$idEgreso->value())->delete();
    }

    public function liquidarDetalle(
        Id $idCliente,
        Id $idLiquidacion,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        array $idVehiculos,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->where('id_cliente', $idCliente->value())
            ->whereDate('fecha', '>=', $fechaDesde->value())
            ->whereDate('fecha', '<=', $fechaHasta->value())
            ->whereNull('id_liquidacion')
            ->update([
                'id_liquidacion' => $idLiquidacion->value(),
                'id_estado' => EnumEstadoEgresoDetalle::Liquidado->value,
                'id_usu_modifico' => $idUsuarioRegistro->value()
            ]);

    }

    public function liberarLiquidacionDetalle(
        Id $idCliente,
        Id $idLiquidacion,
        Id $idUsuarioRegistro
    ): void
    {

        $this->eloquent
            ->where('id_cliente',$idCliente->value())
            ->where('id_liquidacion',$idLiquidacion->value())
            ->update([
                'id_liquidacion' => null,
                'id_estado' => EnumEstadoEgresoDetalle::Activo->value,
                'id_usu_modifico' => $idUsuarioRegistro->value()
            ]);

    }


    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): EgresoDetalleList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'egresoTipo:id,nombre',
            'medioPago:id,nombre',
        )->select(
            'egreso_detalle.*',
            'ce_comprobante_electronico.serie as serie',
            'ce_comprobante_electronico.numero as numero',
            'vehiculos.placa as vehiculo',
            'personal.nombre as personalNombre',
            'personal.apellido as personalApellido',
        )
//            ->leftjoin('tipo_comprobante',  'ce_comprobante_electronico.id_tipo_comprobante', '=', 'tipo_comprobante.id')
            ->join('egreso',  'egreso_detalle.id_egreso', '=', 'egreso.id')
            ->leftjoin('ce_comprobante_electronico',  'egreso.id', '=', 'ce_comprobante_electronico.id_producto')
            ->leftjoin('vehiculos',  'egreso.id_vehiculo', '=', 'vehiculos.id')
            ->leftjoin('personal',  'egreso.id_personal', '=', 'personal.id')
            ->where('egreso.id_cliente',$idCliente->value())
            ->whereDate('egreso.f_registro','>=', $fechaDesde->value())
            ->whereDate('egreso.f_registro','<=', $fechaHasta->value());

        if(!is_null($idVehiculo->value())){
            $models = $models->where('egreso.id_vehiculo', $idVehiculo->value());
        }
        if(!is_null($idPersonal->value())){
            $models = $models->where('egreso.id_personal', $idPersonal->value());
        }

        $models = $models->orderBy('egreso.f_registro', 'desc')
            ->get();


        $collection = new EgresoDetalleList();

        foreach ( $models as $model ){

            $OModel = new EgresoDetalle(
                new Id($model->id , false, 'El id  no tiene el formato correcto'),
                new Id($model->id_egreso , false, 'El id de la egreso no tiene el formato correcto'),
                new Id($model->id_cliente , false, 'El id de la cliente no tiene el formato correcto'),
                new Id($model->id_egreso_tipo , false, 'El id del egreso tipo no tiene el formato correcto'),
                new Text($model->detalle , true, -1, ''),
                new DateFormat($model->fecha, false, 'La fecha no tiene el formato correcto'),
                new NumericFloat($model->importe),
                new NumericInteger($model->id_medio_pago),
                new Text($model->numero_documento , true, -1, ''),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
                new Id($model->id_liquidacion, true, 'El id de la liquidacion no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setEgresoTipo(new Text($model->egresoTipo->nombre, false, -1, ''));
            $OModel->setCodigo(new Text($model->serie.'-'.str_pad((string)$model->numero,8,'0',STR_PAD_LEFT), false, -1, ''));
            $OModel->setVehiculo(new Text($model->vehiculo, false, -1, ''));
            $OModel->setMedioPago(new Text($model->medioPago->nombre, false, -1, ''));
            $OModel->setPersonal(new Text($model->personalNombre ? ($model->personalNombre . ' ' . $model->personalApellido) : null, false, -1, ''));

            $collection->add($OModel);
        }

        return $collection;
    }


}
