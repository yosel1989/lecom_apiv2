<?php

declare(strict_types=1);

namespace Src\V2\Liquidacion\Infrastructure\Repositories;

use App\Enums\EnumEstadoLiquidacion;
use App\Models\V2\Liquidacion as EloquentModelLiquidacion;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;
use Src\V2\Liquidacion\Domain\Liquidacion;
use Src\V2\Liquidacion\Domain\LiquidacionList;

final class EloquentLiquidacionRepository implements LiquidacionRepositoryContract
{
    private EloquentModelLiquidacion $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelLiquidacion;
    }

    public function create(
        Id $_id,
        NumericInteger $_codigo,
        Id $_idCliente,
        Id $_idSede,
        array $_idVehiculos,
        Id $_idPersonal,
        DateFormat $_fechaInicio,
        DateFormat $_fechaFin,
        Text $_archivo,
        Text $_urlArchivo,
        Id $_idUsuarioRegistro,
        ValueBoolean $_local,
        NumericFloat $_monto
    ): void
    {
        $this->eloquent->create([
            'id' => $_id->value(),
            'codigo' => $_codigo->value(),
            'id_cliente' => $_idCliente->value(),
            'id_sede' => $_idSede->value(),
            'id_vehiculos' => $_idVehiculos,
            'id_personal' => $_idPersonal->value(),
            'f_inicio' => $_fechaInicio->value(),
            'f_fin' => $_fechaFin->value(),
            'archivo' => $_archivo->value(),
            'url_archivo' => $_urlArchivo->value(),
//            'id_estado' => $_idEstado->value(),
            'id_usu_registro' => $_idUsuarioRegistro->value(),
            'local' => $_local->value(),
            'monto' => $_monto->value(),
        ]);
    }

    public function delete(
        Id $id
    ): void
    {
        $this->eloquent->findOrFail($id->value())->delete();
    }

    public function find(
        Id $idLiquidacion,
    ): Liquidacion
    {
        $model = $this->eloquent->with('estado:id,nombre')->findOrFail($idLiquidacion->value());

        $OModel = new Liquidacion(
            new Id($model->id, false , 'El id no tiene el formato correcto'),
            new NumericInteger($model->codigo),
            new Id($model->id_cliente, false , 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede, false , 'El id de la sede no tiene el formato correcto'),
            $model->id_vehiculos,
            new Id($model->id_personal, true , 'El id del personal no tiene el formato correcto'),
            new DateFormat($model->f_inicio, false,  'La fecha de inicio no tiene el formato correcto'),
            new DateFormat($model->f_fin, false , 'La fecha final no tiene el formato correcto'),
            new Text($model->archivo, false, -1 , ''),
            new Text($model->url_archivo, false, -1 , ''),
            new NumericInteger($model->id_estado),
            new Id($model->id_usu_registro, false,  'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El ida del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'La fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'La fecha de modificación no tiene el formato correcto'),
            new ValueBoolean($model->local),
            new NumericFloat($model->monto),
        );
        $OModel->setEstado(new Text($model->estado?->nombre, false, -1, ''));
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, false, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

        return $OModel;
    }

    public function collectionByCliente(Id $idCliente, DateFormat $fechaInicio, DateFormat $fechaFin): LiquidacionList
    {
        $collection = $this->eloquent->with(
            'estado:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )
            ->where('id_cliente', $idCliente->value())
            ->whereDate('f_registro', '>=', $fechaInicio->value())
            ->whereDate('f_registro', '<=', $fechaFin->value())
            ->get();

        $output = new LiquidacionList();

        foreach ($collection as $model) {
            $OModel = new Liquidacion(
                new Id($model->id, false , 'El id no tiene el formato correcto'),
                new NumericInteger($model->codigo),
                new Id($model->id_cliente, false , 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, false , 'El id de la sede no tiene el formato correcto'),
                $model->id_vehiculos,
                new Id($model->id_personal, true , 'El id del personal no tiene el formato correcto'),
                new DateFormat($model->f_inicio, false,  'La fecha de inicio no tiene el formato correcto'),
                new DateFormat($model->f_fin, false , 'La fecha final no tiene el formato correcto'),
                new Text($model->archivo, false, -1 , ''),
                new Text($model->url_archivo, false, -1 , ''),
                new NumericInteger($model->id_estado),
                new Id($model->id_usu_registro, false,  'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El ida del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'La fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'La fecha de modificación no tiene el formato correcto'),
                new ValueBoolean($model->local),
                new NumericFloat($model->monto)
            );
            $OModel->setEstado(new Text($model->estado?->nombre, false, -1, ''));
            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, false, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $output->add($OModel);
        }

        return $output;
    }

    public function ultimoCodigoLiquidacion(
        Id $idCliente,
    ): NumericInteger
    {
        $codigo = new NumericInteger(0);
        $result = $this->eloquent->select(DB::raw('MAX(codigo) as codigo'))->where('id_cliente', $idCliente->value());
        if($result->count() > 0){
            $codigo = new NumericInteger($result->first()->codigo);
        }

        return $codigo;
    }


    public function anular(
        Id $id,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
           'id_estado' => EnumEstadoLiquidacion::Anulado->value,
           'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

}
