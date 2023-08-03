<?php

declare(strict_types=1);

namespace Src\V2\Usuario\Infrastructure\Repositories;

use App\Models\User as EloquentModelUsuario;
use Illuminate\Support\Facades\Hash;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Usuario\Domain\Contracts\UsuarioRepositoryContract;
use Src\V2\Usuario\Domain\Usuario;

final class EloquentUsuarioRepository implements UsuarioRepositoryContract
{
    private EloquentModelUsuario $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelUsuario = new EloquentModelUsuario;
    }



    public function collectionByCliente(Id $idCliente): array
    {
        $personal = $this->eloquentModelUsuario->with(
            'perfil:id,nombre',
            'sede:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $personal as $model ){

            $OModel = new Usuario(
                new Id($model->id,true,'El id del usuario no tiene el formato correcto'),
                new Text($model->usuario,true, 20,'El nombre de usuario excede los 20 caracteres'),
                new Text($model->nombres,false, 100,'El nombre excede los 100 caracteres'),
                new Text($model->apellidos,false, 100,'El apellido excede los 100 caracteres'),
                new Id($model->idPersonal,true,'El id del personal no tiene el formato correcto'),
                new Id($model->idPerfil,true,'El id del perfil no tiene el formato correcto'),
                new Id($model->idSede,true,'El id de la sede no tiene el formato correcto'),
                new Text($model->correo,true, 100,'El correo excede los 100 caracteres'),
                new Id($model->idCliente,false,'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setPerfil( new Text( !is_null($model->perfil) ? $model->perfil->nombre : null, true, -1,''));
            $OModel->setSede( new Text( !is_null($model->sede) ? $model->sede->nombre : null, true, -1,''));


            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $usuario,
        Text $clave,
        Text $nombre,
        Text $apellido,
        Id $idPersonal,
        Id $idPerfil,
        Id $idSede,
        Text $correo,
        Id $idCliente,
        NumericInteger $idNivelUsuario,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelUsuario->create([
            'usuario' => $usuario->value(),
            'clave' => Hash::make($clave->value()),
            'nombres' => $nombre->value(),
            'apellidos' => $apellido->value(),
            'correo' => $correo->value(),
            'idPersonal' => $idPersonal->value(),
            'idPerfil' => $idPerfil->value(),
            'idSede' => $idSede->value(),
            'idCliente' => $idCliente->value(),
            'idNivel' => $idNivelUsuario->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $idUsuario,
        Text $nombre,
        Text $apellido,
        Id $idPersonal,
        Id $idPerfil,
        Id $idSede,
        Text $correo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelUsuario->findOrFail($idUsuario->value())->update([
            'nombres' => $nombre->value(),
            'apellidos' => $apellido->value(),
            'correo' => $correo->value(),
            'idPersonal' => $idPersonal->value(),
            'idPerfil' => $idPerfil->value(),
            'idSede' => $idSede->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idUsuario,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelUsuario->findOrFail($idUsuario->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idUsuario,
    ): Usuario
    {
        $model = $this->eloquentModelUsuario->with(
            'perfil:id,nombre',
            'sede:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->findOrFail($idUsuario->value());
        $OModel = new Usuario(
            new Id($model->id,true,'El id del usuario no tiene el formato correcto'),
            new Text($model->usuario,true, 20,'El nombre de usuario excede los 20 caracteres'),
            new Text($model->nombres,false, 100,'El nombre excede los 100 caracteres'),
            new Text($model->apellidos,false, 100,'El apellido excede los 100 caracteres'),
            new Id($model->idPersonal,true,'El id del personal no tiene el formato correcto'),
            new Id($model->idPerfil,true,'El id del perfil no tiene el formato correcto'),
            new Id($model->idSede,true,'El id de la sede no tiene el formato correcto'),
            new Text($model->correo,true, 100,'El correo excede los 100 caracteres'),
            new Id($model->idCliente,false,'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setPerfil( new Text( !is_null($model->perfil) ? $model->perfil->nombre : null, true, -1,''));
        $OModel->setSede( new Text( !is_null($model->sede) ? $model->sede->nombre : null, true, -1,''));
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

        return $OModel;
    }


    public function changePassword(
        Id $idUsuario,
        Text $clave,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelUsuario->findOrFail($idUsuario->value())->update([
            'clave' => Hash::make($clave->value()),
            'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

}
