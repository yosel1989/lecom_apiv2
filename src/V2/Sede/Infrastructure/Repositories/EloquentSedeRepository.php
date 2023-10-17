<?php

declare(strict_types=1);

namespace Src\V2\Sede\Infrastructure\Repositories;

use App\Models\V2\Sede as EloquentModelSede;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Sede\Domain\Contracts\SedeRepositoryContract;
use Src\V2\Sede\Domain\Sede;
use Src\V2\Sede\Domain\SedeShort;

final class EloquentSedeRepository implements SedeRepositoryContract
{
    private EloquentModelSede $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelSede = new EloquentModelSede;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelSede->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Sede(
                new Id($model->id , false, 'El id de la sede no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la sede excede los 100 caracteres'),
                new Text($model->direccion, true, 150, 'La direccion de la sede excede los 150 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelSede->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new SedeShort(
                new Id($model->id , false, 'El id del sede no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la sede excede los 100 caracteres'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        Text $direccion,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $count = $this->eloquentModelSede->select('id')->where('id_cliente', $idCliente->value())->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('La sede ya se encuentra registrada');
        }

        $this->eloquentModelSede->create([
           'nombre' => $nombre->value(),
           'direccion' => $direccion->value(),
           'id_cliente' => $idCliente->value(),
           'id_estado' => $idEstado->value(),
           'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Text $direccion,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $sede = $this->eloquentModelSede->findOrFail($id->value());

        $count = $this->eloquentModelSede->select('id')->where('id', '<>', $id->value())->where('id_cliente', $sede->id_cliente)->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('La sede ya se encuentra registrada');
        }

        $this->eloquentModelSede->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'direccion' => $direccion->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelSede->findOrFail($idSede->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idSede,
    ): Sede
    {
        $model = $this->eloquentModelSede->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->findOrFail($idSede->value());
        $OModel = new Sede(
            new Id($model->id , false, 'El id del sede no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del sede excede los 100 caracteres'),
            new Text($model->direccion, true, 150, 'La dirección de la sede excede los 105 caracteres'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
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

}
