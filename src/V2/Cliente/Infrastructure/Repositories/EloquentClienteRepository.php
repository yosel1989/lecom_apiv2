<?php

declare(strict_types=1);

namespace Src\V2\Cliente\Infrastructure\Repositories;

use App\Enums\IdTipoCliente;
use App\Models\V2\Cliente as EloquentModelCliente;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Cliente\Domain\Contracts\ClienteRepositoryContract;
use Src\V2\Cliente\Domain\Cliente;
use Src\V2\Cliente\Domain\ClienteShort;

final class EloquentClienteRepository implements ClienteRepositoryContract
{
    private EloquentModelCliente $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelCliente = new EloquentModelCliente;
    }

    public function collection(): array
    {
        $personal = $this->eloquentModelCliente->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'tipoDocumento:id,nombre')->get();

        $arrVehicles = array();

        foreach ( $personal as $model ){

            $OModel = new Cliente(
                new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
                new NumericInteger($model->codigo),
                new NumericInteger($model->idTipoDocumento ? $model->idTipoDocumento->value : null),
                new Text($model->numeroDocumento,false,25, 'El número de documento excede los 25 caracteres'),
                new Text($model->nombre,true,150, 'El nombre del cliente excede los 150 caracteres'),
                new Text($model->nombreContacto,true,150, 'El nombre del contacto excede los 150 caracteres'),
                new Text($model->correo,true,150, 'El correo excede los 150 caracteres'),
                new Text($model->direccion,true,150, 'La dirección excede los 150 caracteres'),
                new Text($model->telefono1,true,15, 'El telefono1 excede los 15 caracteres'),
                new Text($model->telefono2,true,15, 'El telefono2 excede los 15 caracteres'),
                new NumericInteger($model->idTipo->value),
                new Id($model->idClientePadre,true, 'El id del cliente padre tiene un formato incorrecto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );


            /**
             * @var string $tipoCliente
             */
            $tipoCliente = "";

            switch ($model->idTipo->value){
                case IdTipoCliente::Cliente->value: $tipoCliente = "Cliente";break;
                case IdTipoCliente::Reseller->value: $tipoCliente = "Reseller";break;
                default: $tipoCliente = "";break;
            }

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setTipoDocumento(new Text(!is_null($model->tipoDocumento) ? $model->tipoDocumento->nombre : null, true, -1));
            $OModel->setTipo( new Text( $tipoCliente, false,-1,'') );


            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function collectionByCliente(Id $idCliente): array
    {
        $personal = $this->eloquentModelCliente->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'tipoDocumento:id,nombre')->where('idClientePadre',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $personal as $model ){

            $OModel = new Cliente(
                new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
                new NumericInteger($model->codigo),
                new NumericInteger($model->idTipoDocumento ? $model->idTipoDocumento->value : null),
                new Text($model->numeroDocumento,false,25, 'El número de documento excede los 25 caracteres'),
                new Text($model->nombre,true,150, 'El nombre del cliente excede los 150 caracteres'),
                new Text($model->nombreContacto,true,150, 'El nombre del contacto excede los 150 caracteres'),
                new Text($model->correo,true,150, 'El correo excede los 150 caracteres'),
                new Text($model->direccion,true,150, 'La dirección excede los 150 caracteres'),
                new Text($model->telefono1,true,15, 'El telefono1 excede los 15 caracteres'),
                new Text($model->telefono2,true,15, 'El telefono2 excede los 15 caracteres'),
                new NumericInteger($model->idTipo->value),
                new Id($model->idClientePadre,true, 'El id del cliente padre tiene un formato incorrecto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            /**
             * @var string $tipoCliente
             */
            $tipoCliente = "";

            switch ($model->idTipo->value){
                case IdTipoCliente::Cliente: $tipoCliente = "Cliente";break;
                case IdTipoCliente::Reseller: $tipoCliente = "Reseller";break;
                default: $tipoCliente = "";break;
            }

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setTipoDocumento(new Text(!is_null($model->tipoDocumento) ? $model->tipoDocumento->nombre : null, true, -1));
            $OModel->setTipo( new Text( $tipoCliente, false,-1,'') );


            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function ListByCliente(Id $idCliente): array
    {
        $personal = $this->eloquentModelCliente->where('idClientePadre',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $personal as $model ){

            $OModel = new ClienteShort(
                new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
                new NumericInteger($model->codigo),
                new NumericInteger($model->idTipoDocumento ? $model->idTipoDocumento->value : null),
                new Text($model->numeroDocumento,false,25, 'El número de documento excede los 25 caracteres'),
                new Text($model->nombre,true,150, 'El nombre del cliente excede los 150 caracteres'),
                new NumericInteger($model->idTipo->value),
                new Id($model->idClientePadre,true, 'El id del cliente padre tiene un formato incorrecto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        NumericInteger $_idTipoDocumento,
        Text $_numeroDocumento,
        Text $_nombre,
        Text $_nombreContacto,
        Text $_correo,
        Text $_direccion,
        Text $_telefono1,
        Text $_telefono2,
        NumericInteger $_idTipo,
        Id $_idCliente,
        NumericInteger $_idEstado,
        Id $_idUsuarioRegistro
    ): void
    {
        $count = DB::table('clientes')->count();
        $this->eloquentModelCliente->create([
            'codigo' => ($count + 1),
            'idTipoDocumento' => $_idTipoDocumento->value(),
            'numeroDocumento' => $_numeroDocumento->value(),
            'nombre' => $_nombre->value(),
            'nombreContacto' => $_nombreContacto->value(),
            'correo' => $_correo->value(),
            'direccion' => $_direccion->value(),
            'telefono1' => $_telefono1->value(),
            'telefono2' => $_telefono2->value(),
            'idTipo' => $_idTipo->value(),
            'idClientePadre' => $_idCliente->value(),
            'idEstado' => $_idEstado->value(),
            'idUsuarioRegistro' => $_idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $idCliente,
        NumericInteger $_idTipoDocumento,
        Text $_numeroDocumento,
        Text $_nombre,
        Text $_nombreContacto,
        Text $_correo,
        Text $_direccion,
        Text $_telefono1,
        Text $_telefono2,
        NumericInteger $_idEstado,
        Id $_idUsuarioRegistro
    ): void
    {
        $this->eloquentModelCliente->findOrFail($idCliente->value())->update([
            'idTipoDocumento' => $_idTipoDocumento->value(),
            'numeroDocumento' => $_numeroDocumento->value(),
            'nombre' => $_nombre->value(),
            'nombreContacto' => $_nombreContacto->value(),
            'correo' => $_correo->value(),
            'direccion' => $_direccion->value(),
            'telefono1' => $_telefono1->value(),
            'telefono2' => $_telefono2->value(),
            'idEstado' => $_idEstado->value(),
            'idUsuarioModifico' => $_idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelCliente->findOrFail($idCliente->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idCliente,
    ): Cliente
    {
        $model = $this->eloquentModelCliente->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'tipoDocumento:id,nombre')->findOrFail($idCliente->value());
        $OModel = new Cliente(
            new Id($model->id , false, 'El id del personal no tiene el formato correcto'),
            new NumericInteger($model->codigo),
            new NumericInteger($model->idTipoDocumento ? $model->idTipoDocumento->value : null),
            new Text($model->numeroDocumento,false,25, 'El número de documento excede los 25 caracteres'),
            new Text($model->nombre,true,150, 'El nombre del cliente excede los 150 caracteres'),
            new Text($model->nombreContacto,true,150, 'El nombre del contacto excede los 150 caracteres'),
            new Text($model->correo,true,150, 'El correo excede los 150 caracteres'),
            new Text($model->direccion,true,150, 'La dirección excede los 150 caracteres'),
            new Text($model->telefono1,true,15, 'El telefono1 excede los 15 caracteres'),
            new Text($model->telefono2,true,15, 'El telefono2 excede los 15 caracteres'),
            new NumericInteger($model->idTipo->value),
            new Id($model->idClientePadre,true, 'El id del cliente padre tiene un formato incorrecto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );


        /**
         * @var string $tipoCliente
         */
        $tipoCliente = "";

        switch ($model->idTipo->value){
            case IdTipoCliente::Cliente: $tipoCliente = "Cliente";break;
            case IdTipoCliente::Reseller: $tipoCliente = "Reseller";break;
            default: $tipoCliente = "";break;
        }

        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setTipoDocumento(new Text(!is_null($model->tipoDocumento) ? $model->tipoDocumento->nombre : null, true, -1));
        $OModel->setTipo( new Text( $tipoCliente, false,-1,'') );


        return $OModel;
    }

}
