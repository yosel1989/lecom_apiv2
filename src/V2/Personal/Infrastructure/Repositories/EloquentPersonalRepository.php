<?php

declare(strict_types=1);

namespace Src\V2\Personal\Infrastructure\Repositories;

use App\Models\V2\Personal as EloquentModelPersonal;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Personal\Domain\Contracts\PersonalRepositoryContract;
use Src\V2\Personal\Domain\Personal;
use Src\V2\Personal\Domain\PersonalShort;

final class EloquentPersonalRepository implements PersonalRepositoryContract
{
    private EloquentModelPersonal $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelPersonal = new EloquentModelPersonal;
    }



    public function collectionByCliente(Id $idCliente): array
    {
        $personal = $this->eloquentModelPersonal->with('sede:id,nombre', 'usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'tipoDocumento:id,nombre')->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $personal as $model ){

            $OModel = new Personal(
                new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
                new Text($model->foto,true, 99999,'La foto excede el maximo de caracteres'),
                new Text($model->nombre,false, 150,'El nombre excede los 150 caracteres'),
                new Text($model->apellido,false, 150,'El apellido excede los 150 caracteres'),
                new NumericInteger($model->idTipoDocumento->value),
                new Text($model->numeroDocumento,true, 150,'El numero de documento excede los 150 caracteres'),
                new Text($model->correo,true, 150,'El correo excede los 150 caracteres'),
                new Id($model->idCliente,false,'El id del cliente no tiene el formato correcto'),
                new Id($model->idSede,true,'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede( new Text( !is_null($model->sede) ? $model->sede->nombre : null,true, -1 ) );
            $OModel->setTipoDocumento(new Text(!is_null($model->tipoDocumento) ? $model->tipoDocumento->nombre : null, true, -1));


            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function ListByCliente(Id $idCliente): array
    {
        $personal = $this->eloquentModelPersonal->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $personal as $model ){

            $OModel = new PersonalShort(
                new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
                new Text($model->nombre,false, 150,'El nombre excede los 150 caracteres'),
                new Text($model->apellido,false, 150,'El apellido excede los 150 caracteres'),
                new Id($model->idCliente,false,'El id del cliente no tiene el formato correcto'),
                new Id($model->idSede,true,'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $foto,
        Text $nombre,
        Text $apellido,
        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $correo,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelPersonal->create([
            'foto' => $foto->value(),
            'nombre' => $nombre->value(),
            'apellido' => $apellido->value(),
            'idTipoDocumento' => $idTipoDocumento->value(),
            'numeroDocumento' => $numeroDocumento->value(),
            'correo' => $correo->value(),
            'idCliente' => $idCliente->value(),
            'idSede' => $idSede->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $idPersonal,
        Text $foto,
        Text $nombre,
        Text $apellido,
        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $correo,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelPersonal->findOrFail($idPersonal->value())->update([
            'foto' => $foto->value(),
            'nombre' => $nombre->value(),
            'apellido' => $apellido->value(),
            'idTipoDocumento' => $idTipoDocumento->value(),
            'numeroDocumento' => $numeroDocumento->value(),
            'correo' => $correo->value(),
            'idSede' => $idSede->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idPersonal,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelPersonal->findOrFail($idPersonal->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idPersonal,
    ): Personal
    {
        $model = $this->eloquentModelPersonal->with(
            'sede:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoDocumento:id,nombre',
        )->findOrFail($idPersonal->value());
        $OModel = new Personal(
            new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
            new Text($model->foto,true, 99999,'La foto excede el maximo de caracteres'),
            new Text($model->nombre,false, 150,'El nombre excede los 150 caracteres'),
            new Text($model->apellido,false, 150,'El apellido excede los 150 caracteres'),
            new NumericInteger($model->idTipoDocumento->value),
            new Text($model->numeroDocumento,true, 150,'El numero de documento excede los 150 caracteres'),
            new Text($model->correo,true, 150,'El correo excede los 150 caracteres'),
            new Id($model->idCliente,false,'El id del cliente no tiene el formato correcto'),
            new Id($model->idSede,true,'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );

        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede( new Text( !is_null($model->sede) ? $model->sede->nombre : null,true, -1 ) );
        $OModel->setTipoDocumento(new Text(!is_null($model->tipoDocumento) ? $model->tipoDocumento->nombre : null, true, -1));


        return $OModel;
    }

}
