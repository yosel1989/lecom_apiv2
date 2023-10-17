<?php

declare(strict_types=1);

namespace Src\V2\Pos\Infrastructure\Repositories;

use App\Models\V2\Pos as EloquentModelPos;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Pos\Domain\Contracts\PosRepositoryContract;
use Src\V2\Pos\Domain\Pos;
use Src\V2\Pos\Domain\PosShort;

final class EloquentPosRepository implements PosRepositoryContract
{
    private EloquentModelPos $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelPos = new EloquentModelPos;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelPos->with(
            'sede:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Pos(
                new Id($model->id , false, 'El id de la pos no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la pos excede los 100 caracteres'),
                new Text($model->imei, false, 25, 'El imei excede los 25 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelPos
            ->select(
                'id',
                'nombre',
                'id_sede',
                'imei',
                'id_estado',
                'id_eliminado'
            )
            ->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new PosShort(
                new Id($model->id , false, 'El id del pos no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la pos excede los 100 caracteres'),
                new Text($model->imei, false, 25, 'El imei excede los 25 caracteres'),
                new Id($model->id_sede , true, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        Text $imei,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $existe = $this->eloquentModelPos
            ->where('id_cliente' , $idCliente->value())
            ->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value()))
            //->where('id_tipo_comprobante',$idTipoComprobante->value())
            //->where('id_sede', $idSede->value())
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('El equipo POS ya se encuentra registrado');
        }

        $existe = $this->eloquentModelPos
            ->where('id_cliente' , $idCliente->value())
            ->where('imei', trim($imei->value()))
            //->where('id_tipo_comprobante',$idTipoComprobante->value())
            //->where('id_sede', $idSede->value())
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('El imei del POS ya se encuentra registrado');
        }

        $existe = $this->eloquentModelPos
            ->where('imei', trim($imei->value()))
            //->where('id_tipo_comprobante',$idTipoComprobante->value())
            //->where('id_sede', $idSede->value())
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('El imei del POS ya se encuentra registrado con otro cliente');
        }

        $this->eloquentModelPos->create([
            'nombre' => $nombre->value(),
            'imei' => $imei->value(),
            'id_cliente' => $idCliente->value(),
            'id_sede' => $idSede->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Text $imei,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $pos = $this->eloquentModelPos->findOrFail($id->value());

        $existe = $this->eloquentModelPos
            ->where('id' , '<>', $id->value())
            ->where('id_cliente' , $pos->id_cliente)
            ->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value()))
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('El equipo POS ya se encuentra registrado');
        }

        $existe = $this->eloquentModelPos
            ->where('id' , '<>', $id->value())
            ->where('id_cliente' , $pos->id_cliente)
            ->where('imei', trim($imei->value()))
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('El imei del POS ya se encuentra registrado');
        }

        $existe = $this->eloquentModelPos
            ->where('id' , '<>', $id->value())
            ->where('imei', trim($imei->value()))
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('El imei del POS ya se encuentra registrado con otro cliente');
        }

        $pos->update([
            'nombre' => $nombre->value(),
            'imei' => $imei->value(),
            'id_sede' => $idSede->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idPos,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelPos->findOrFail($idPos->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idPos,
    ): Pos
    {
        $model = $this->eloquentModelPos->with(
            'sede:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->findOrFail($idPos->value());
        $OModel = new Pos(
            new Id($model->id , false, 'El id del pos no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del pos excede los 100 caracteres'),
            new Text($model->imei, false, 25, 'El imei excede los 25 caracteres'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));


        return $OModel;
    }

}
