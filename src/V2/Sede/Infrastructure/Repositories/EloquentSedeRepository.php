<?php

declare(strict_types=1);

namespace Src\V2\Sede\Infrastructure\Repositories;

use App\Models\V2\Sede as EloquentModelSede;
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
        $models = $this->eloquentModelSede->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Sede(
                new Id($model->id , false, 'El id de la sede no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la sede excede los 100 caracteres'),
                new Text($model->direccion, true, 150, 'La direccion de la sede excede los 150 caracteres'),
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

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelSede->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new SedeShort(
                new Id($model->id , false, 'El id del sede no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la sede excede los 100 caracteres'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
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
        $this->eloquentModelSede->create([
           'nombre' => $nombre->value(),
           'direccion' => $direccion->value(),
           'idCliente' => $idCliente->value(),
           'idEstado' => $idEstado->value(),
           'idUsuarioRegistro' => $idUsuarioRegistro->value()
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
        $this->eloquentModelSede->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'direccion' => $direccion->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelSede->findOrFail($idSede->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idSede,
    ): Sede
    {
        $model = $this->eloquentModelSede->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->findOrFail($idSede->value());
        $OModel = new Sede(
            new Id($model->id , false, 'El id del sede no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del sede excede los 100 caracteres'),
            new Text($model->direccion, true, 150, 'La dirección de la sede excede los 105 caracteres'),
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


        return $OModel;
    }

}
