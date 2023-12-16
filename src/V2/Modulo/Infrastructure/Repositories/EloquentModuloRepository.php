<?php

declare(strict_types=1);

namespace Src\V2\Modulo\Infrastructure\Repositories;

use App\Models\V2\Modulo as EloquentModelModulo;
use App\Models\V2\PerfilModulo as EloquentModelPerfilModulo;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Modulo\Domain\Contracts\ModuloRepositoryContract;
use Src\V2\Modulo\Domain\Modulo;
use Src\V2\Modulo\Domain\ModuloShort;

final class EloquentModuloRepository implements ModuloRepositoryContract
{
    private EloquentModelModulo $eloquentModelModulo;
    private EloquentModelPerfilModulo $eloquentModelPerfilModulo;

    public function __construct()
    {
        $this->eloquentModelModulo = new EloquentModelModulo;
        $this->eloquentModelPerfilModulo = new EloquentModelPerfilModulo;
    }


    public function collection(): array
    {
        $models = $this->eloquentModelModulo->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Modulo(
                new Id($model->id , false, 'El id de la modulo no tiene el formato correcto'),
                new Text($model->nombre, false, -1),
                new Text($model->link, true, -1),
                new Text($model->icono, false, -1),
                new Text($model->codigo, false, -1),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function list(): array
    {
        $models = $this->eloquentModelModulo->select(
            'id',
            'nombre',
            'link',
            'codigo',
            'id_estado',
            'id_eliminado',
        )->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ModuloShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1),
                new Text($model->link, true, -1),
                new Text($model->icono, false, -1),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listToPerfil( Id $idPerfil): array
    {
        $models = $this->eloquentModelModulo->select(
            'id',
            'nombre',
            'link',
            'codigo',
            'id_estado',
            'id_eliminado',
        )->get();

        $collection = array();

        foreach ( $models as $model ){

            $OModel = new ModuloShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1),
                new Text($model->link, true, -1),
                new Text($model->icono, false, -1),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $collection[] = $OModel;
        }

        $moduloPerfil = $this->eloquentModelPerfilModulo->where('id_perfil',$idPerfil->value());
        $modulosActivados = $moduloPerfil->count() > 0 ? $moduloPerfil->first()->modulos : [];

        foreach ( $collection as $modulo ){
            if(in_array($modulo->getId()->value(), $modulosActivados)){
                $modulo->setActivado(true);
            }else{
                $modulo->setActivado(false);
            }
        }

        return $collection;
    }


    public function listToUsuarioPerfil( Id $idPerfil): array
    {
        $models = $this->eloquentModelModulo->select(
            'id',
            'nombre',
            'link',
            'icono',
            'id_estado',
            'id_eliminado',
        )->get();

        $collection = array();

        foreach ( $models as $model ){

            $OModel = new ModuloShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1),
                new Text($model->link, true, -1),
                new Text($model->icono, true, -1),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $collection[] = $OModel;
        }

        $moduloPerfil = $this->eloquentModelPerfilModulo->where('id_perfil',$idPerfil->value());
        $modulosActivados = $moduloPerfil->count() > 0 ? $moduloPerfil->first()->modulos : [];

        foreach ( $collection as $modulo ){
            if(in_array($modulo->getId()->value(), $modulosActivados)){
                $modulo->setActivado(true);
            }else{
                $modulo->setActivado(false);
            }
        }

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
        $this->eloquentModelModulo->create([
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
        $this->eloquentModelModulo->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'link' => $link->value(),
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
        $model = $this->eloquentModelModulo->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->findOrFail($idModulo->value());
        $OModel = new Modulo(
            new Id($model->id , false, 'El id del modulo no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del modulo excede los 100 caracteres'),
            new Text($model->link, true, -1),
            new Text($model->icono, false, -1),
            new Text($model->codigo, false, -1),
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
