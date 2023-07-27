<?php

declare(strict_types=1);

namespace Src\V2\Serie\Infrastructure\Repositories;

use App\Models\V2\Serie as EloquentModelSerie;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Serie\Domain\Contracts\SerieRepositoryContract;
use Src\V2\Serie\Domain\Serie;
use Src\V2\Serie\Domain\SerieShort;

final class EloquentSerieRepository implements SerieRepositoryContract
{
    private EloquentModelSerie $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelSerie = new EloquentModelSerie;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelSerie->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'sede:id,nombre' ,
            'tipo:id,nombre' ,
//            'pos:id,nombre'
        )->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Serie(
                new Id($model->id , false, 'El id de la Serie no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la Serie excede los 100 caracteres'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->idTipo, true, 'El id del tipo de serie no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));
            $OModel->setTipo(new Text(!is_null($model->tipo) ? $model->tipo->nombre : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelSerie->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new SerieShort(
                new Id($model->id , false, 'El id del Serie no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la Serie excede los 100 caracteres'),
                new Id($model->idSede , true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->idTipo , true, 'El id del tipo de pos no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        Id $idCliente,
        Id $idSede,
        Id $idTipo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelSerie->create([
            'nombre' => $nombre->value(),
            'idCliente' => $idCliente->value(),
            'idSede' => $idSede->value(),
            'idTipo' => $idTipo->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Id $idSede,
        Id $idTipoSerie,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelSerie->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'idSede' => $idSede->value(),
            'idTipoSerie' => $idTipoSerie->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idSerie,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelSerie->findOrFail($idSerie->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idSerie,
    ): Serie
    {
        $model = $this->eloquentModelSerie->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'sede:id,nombre'
        )->findOrFail($idSerie->value());
        $OModel = new Serie(
            new Id($model->id , false, 'El id del Serie no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del Serie excede los 100 caracteres'),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
            new Id($model->idTipoSerie, true, 'El id del tipo de serie no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));
        $OModel->setTipo(new Text(!is_null($model->tipo) ? $model->tipo->nombre : null, true, -1));


        return $OModel;
    }

}
