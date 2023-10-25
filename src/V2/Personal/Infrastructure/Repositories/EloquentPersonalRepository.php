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
        $personal = $this->eloquentModelPersonal->with(
            'sede:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipoDocumento:id,nombre'
        )->where('id_cliente',$idCliente->value())
        ->orderBy('nombre','ASC')
        ->get();
        $arrVehicles = array();

        foreach ( $personal as $model ){

            $OModel = new Personal(
                new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
                new Text($model->foto,true, 99999,'La foto excede el maximo de caracteres'),
                new Text($model->nombre,false, 150,'El nombre excede los 150 caracteres'),
                new Text($model->apellido,false, 150,'El apellido excede los 150 caracteres'),
                new NumericInteger($model->id_tipo_documento->value),
                new Text($model->numero_documento,true, 150,'El numero de documento excede los 150 caracteres'),
                new Text($model->correo,true, 150,'El correo excede los 150 caracteres'),
                new Id($model->id_cliente,false,'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede,true,'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede( new Text( !is_null($model->sede) ? $model->sede->nombre : null,true, -1 ) );
            $OModel->setTipoDocumento(new Text(!is_null($model->tipoDocumento) ? $model->tipoDocumento->nombre : null, true, -1));
            $OModel->setFotoBase64(new Text(null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function ListByCliente(Id $idCliente): array
    {
        $personal = $this->eloquentModelPersonal
            ->select(
                'id',
                'nombre',
                'apellido',
                'id_cliente',
                'id_sede',
                'id_estado',
                'id_eliminado'
            )->where('id_cliente',$idCliente->value())->orderBy('nombre','ASC')->get();

        $arrVehicles = array();

        foreach ( $personal as $model ){

            $OModel = new PersonalShort(
                new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
                new Text($model->nombre,false, 150,'El nombre excede los 150 caracteres'),
                new Text($model->apellido,false, 150,'El apellido excede los 150 caracteres'),
                new Id($model->id_cliente,false,'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede,true,'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Id $id,
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
            'id' => $id->value(),
            'foto' => $foto->value(),
            'nombre' => $nombre->value(),
            'apellido' => $apellido->value(),
            'id_tipo_documento' => $idTipoDocumento->value(),
            'numero_documento' => $numeroDocumento->value(),
            'correo' => $correo->value(),
            'id_cliente' => $idCliente->value(),
            'id_sede' => $idSede->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
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
            'id_tipo_documento' => $idTipoDocumento->value(),
            'numero_documento' => $numeroDocumento->value(),
            'correo' => $correo->value(),
            'id_sede' => $idSede->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idPersonal,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelPersonal->findOrFail($idPersonal->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idPersonal,
    ): Personal
    {
        ini_set('max_execution_time', '180');

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
            new NumericInteger($model->id_tipo_documento->value),
            new Text($model->numero_documento,true, 150,'El numero de documento excede los 150 caracteres'),
            new Text($model->correo,true, 150,'El correo excede los 150 caracteres'),
            new Id($model->id_cliente,false,'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede,true,'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $fotoBase64 = null;
//        if($model->foto){
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
//            curl_setopt($ch, CURLOPT_URL, $model->foto);
//            $fotoBase64 = base64_encode(curl_exec($ch));
//            curl_close($ch);
//        }
//        $fotoBase64 = $model->foto ? base64_encode(file_get_contents($model->foto,false,$context)) : null;

        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede( new Text( !is_null($model->sede) ? $model->sede->nombre : null,true, -1 ) );
        $OModel->setTipoDocumento(new Text(!is_null($model->tipoDocumento) ? $model->tipoDocumento->nombre : null, true, -1));
        $OModel->setFotoBase64(new Text(!is_null($fotoBase64) ? $fotoBase64 : null, true, -1));

        return $OModel;
    }

}
