<?php

declare(strict_types=1);

namespace Src\V2\Perfil\Infrastructure\Repositories;

use App\Models\V2\Perfil as EloquentModelPerfil;
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
        $models = $this->eloquentModelPerfil->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Perfil(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->idNivelUsuario->value),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setNivelUsuario(new Text(""));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function collectionByClienteByNivel(Id $idCliente, NumericInteger $idNivelUsuario): array
    {
        $models = $this->eloquentModelPerfil->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->where('idCliente',$idCliente->value())->where('idNivelUsuario',$idNivelUsuario->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Perfil(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->idNivelUsuario->value),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
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
        $models = $this->eloquentModelPerfil->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new PerfilShort(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->idNivelUsuario->value),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByClienteByNivel(Id $idCliente, NumericInteger $idNivelUsuario): array
    {
        $models = $this->eloquentModelPerfil->where('idCliente',$idCliente->value())->where('idNivelUsuario', $idNivelUsuario->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new PerfilShort(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->idNivelUsuario->value),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        NumericInteger $idNivelUsuario,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelPerfil->create([
           'nombre' => $nombre->value(),
           'idNivelUsuario' => $idNivelUsuario->value(),
           'idCliente' => $idCliente->value(),
           'idEstado' => $idEstado->value(),
           'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelPerfil->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idPerfil,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelPerfil->findOrFail($idPerfil->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
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
            new NumericInteger($model->idNivelUsuario->value),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setNivelUsuario(new Text(""));


        return $OModel;
    }

}
