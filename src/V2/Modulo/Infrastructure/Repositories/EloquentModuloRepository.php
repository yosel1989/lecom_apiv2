<?php

declare(strict_types=1);

namespace Src\V2\Modulo\Infrastructure\Repositories;

use App\Models\V2\Modulo as EloquentModelModulo;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Modulo\Domain\Contracts\ModuloRepositoryContract;
use Src\V2\Modulo\Domain\Modulo;
use Src\V2\Modulo\Domain\ModuloShort;

final class EloquentModuloRepository implements ModuloRepositoryContract
{
    private EloquentModelModulo $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelModulo = new EloquentModelModulo;
    }


    public function collection(): array
    {
        $models = $this->eloquentModelModulo->all();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Modulo(
                new Id($model->id , false, 'El id de la modulo no tiene el formato correcto'),
                new Text($model->nombre, false, -1),
                new Text($model->icono, false, -1),
                new Text($model->codigo, false, -1),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsurioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(""));
            $OModel->setUsuarioModifico(new Text(""));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function list(): array
    {
        $models = $this->eloquentModelModulo->select(
            'id',
            'nombre',
            'codigo',
            'idEstado',
            'idEliminado',
        )->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ModuloShort(
                new Id($model->id , false, 'El id del modulo no tiene el formato correcto'),
                new Text($model->nombre, false, -1),
                new Text($model->icono, false, -1),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        Text $icono,
        Text $codigo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelModulo->create([
            'nombre' => $nombre->value(),
            'icono' => $icono->value(),
            'codigo' => $codigo->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Text $icono,
        Text $codigo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelModulo->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'icono' => $icono->value(),
            'codigo' => $codigo->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idModulo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelModulo->findOrFail($idModulo->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idModulo,
    ): Modulo
    {
        $model = $this->eloquentModelModulo->findOrFail($idModulo->value());
        $OModel = new Modulo(
            new Id($model->id , false, 'El id del modulo no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del modulo excede los 100 caracteres'),
            new Text($model->nombre, false, -1),
            new Text($model->icono, false, -1),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsurioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(""));
        $OModel->setUsuarioModifico(new Text(""));

        return $OModel;
    }

}
