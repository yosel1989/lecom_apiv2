<?php

declare(strict_types=1);

namespace Src\V2\MotivoTraslado\Infrastructure\Repositories;

use App\Models\V2\MotivoTraslado as EloquentModelMotivoTraslado;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\MotivoTraslado\Domain\Contracts\MotivoTrasladoRepositoryContract;
use Src\V2\MotivoTraslado\Domain\MotivoTraslado;
use Src\V2\MotivoTraslado\Domain\MotivoTrasladoShort;

final class EloquentMotivoTrasladoRepository implements MotivoTrasladoRepositoryContract
{
    private EloquentModelMotivoTraslado $eloquentModelMotivoTraslado;

    public function __construct()
    {
        $this->eloquentModelMotivoTraslado = new EloquentModelMotivoTraslado;
    }


    public function collection(): array
    {
        $models = $this->eloquentModelMotivoTraslado->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->get();

        $arrVehicles = array();

        return $arrVehicles;
    }

    public function list(): array
    {
        $models = $this->eloquentModelMotivoTraslado->select(
            'id',
            'nombre',
            'id_estado'
        )->where('id_estado', 1)->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new MotivoTrasladoShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listToPerfil( Id $idPerfil): array
    {
        $models = $this->eloquentModelMotivoTraslado->select(
            'id',
            'nombre',
            'link',
            'codigo',
            'id_estado',
            'id_eliminado',
        )->get();

        $collection = array();


        return $collection;
    }


    public function listToUsuarioPerfil( Id $idPerfil): array
    {
        $models = $this->eloquentModelMotivoTraslado->select(
            'id',
            'nombre',
            'link',
            'icono',
            'id_estado',
            'id_eliminado',
        )->get();

        $collection = array();

        return $collection;
    }


    public function create(
        Text $nombre,
        Text $link,
        Text $icono,
        Text $codigo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelMotivoTraslado->create([
            'nombre' => $nombre->value(),
            'link' => $link->value(),
            'icono' => $icono->value(),
            'codigo' => $codigo->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Text $link,
        Text $icono,
        Text $codigo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelMotivoTraslado->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'link' => $link->value(),
            'icono' => $icono->value(),
            'codigo' => $codigo->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idMotivoTraslado,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelMotivoTraslado->findOrFail($idMotivoTraslado->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idMotivoTraslado,
    ): MotivoTraslado
    {
        $model = $this->eloquentModelMotivoTraslado->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->findOrFail($idMotivoTraslado->value());
        $OModel = new MotivoTraslado(
            new Id($model->id , false, 'El id del MotivoTraslado no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del MotivoTraslado excede los 100 caracteres'),
            new NumericInteger($model->idEstado->value),
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
