<?php

declare(strict_types=1);

namespace Src\V2\Perfil\Infrastructure\Repositories;

use App\Models\V2\Perfil as EloquentModelPerfil;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Perfil\Domain\Contracts\PerfilRepositoryContract;
use Src\V2\Perfil\Domain\Perfil;
use Src\V2\Perfil\Domain\PerfilShort;

final class EloquentPerfilRepository implements PerfilRepositoryContract
{
    private EloquentModelPerfil $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelPerfil = new EloquentModelPerfil;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelPerfil->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Perfil(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->id_nivel_usuario->value),
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
            $OModel->setNivelUsuario(new Text(""));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function collectionByClienteByNivel(Id $idCliente, NumericInteger $id_nivel_usuario): array
    {
        $models = $this->eloquentModelPerfil->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())->where('id_nivel_usuario',$id_nivel_usuario->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Perfil(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->id_nivel_usuario->value),
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
            $OModel->setNivelUsuario(new Text(""));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelPerfil->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new PerfilShort(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->id_nivel_usuario->value),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByClienteByNivel(Id $idCliente, NumericInteger $id_nivel_usuario): array
    {
        $models = $this->eloquentModelPerfil->where('id_cliente',$idCliente->value())->where('id_nivel_usuario', $id_nivel_usuario->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new PerfilShort(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->id_nivel_usuario->value),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        NumericInteger $id_nivel_usuario,
        Id $idCliente,
        NumericInteger $id_estado,
        Id $id_usu_registro
    ): void
    {
        $count = $this->eloquentModelPerfil->select('id')->where('id_cliente', $idCliente->value())->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El perfil ya se encuentra registrado');
        }

        $this->eloquentModelPerfil->create([
           'nombre' => $nombre->value(),
           'id_nivel_usuario' => $id_nivel_usuario->value(),
           'id_cliente' => $idCliente->value(),
           'id_estado' => $id_estado->value(),
           'id_usu_registro' => $id_usu_registro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $id_estado,
        Id $id_usu_registro
    ): void
    {
        $perfil = $this->eloquentModelPerfil->findOrFail($id->value());

        $count = $this->eloquentModelPerfil->select('id')->where('id', '<>', $id->value())->where('id_cliente', $perfil->id_cliente)->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El perfil ya se encuentra registrado');
        }

        $perfil->update([
            'nombre' => $nombre->value(),
            'id_estado' => $id_estado->value(),
            'id_usu_modifico' => $id_usu_registro->value()
        ]);
    }

    public function changeState(
        Id $idPerfil,
        NumericInteger $id_estado,
        Id $id_usu_modifico
    ): void
    {
        $this->eloquentModelPerfil->findOrFail($idPerfil->value())->update([
           'id_estado' => $id_estado->value(),
           'id_usu_modifico' => $id_usu_modifico->value()
        ]);
    }

    public function find(
        Id $idPerfil,
    ): Perfil
    {
        $model = $this->eloquentModelPerfil->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->findOrFail($idPerfil->value());
        $OModel = new Perfil(
            new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
            new NumericInteger($model->id_nivel_usuario->value),
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
        $OModel->setNivelUsuario(new Text(""));


        return $OModel;
    }

}
