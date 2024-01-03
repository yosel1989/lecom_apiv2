<?php

declare(strict_types=1);

namespace Src\V2\ModuloMenu\Infrastructure\Repositories;

use App\Enums\EnumTipoMenu;
use App\Models\V2\ModuloMenu as EloquentModelModuloMenu;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ModuloMenu\Domain\Contracts\ModuloMenuRepositoryContract;
use Src\V2\ModuloMenu\Domain\ModuloMenu;
use Src\V2\ModuloMenu\Domain\ModuloMenuShort;

final class EloquentModuloMenuRepository implements ModuloMenuRepositoryContract
{
    private EloquentModelModuloMenu $eloquentModelModuloMenu;

    public function __construct()
    {
        $this->eloquentModelModuloMenu = new EloquentModelModuloMenu;
    }


    public function collection(NumericInteger $idModulo): array
    {
        $models = $this->eloquentModelModuloMenu->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'modulo:id,nombre',
            'hijos'
        )->where('id_modulo', $idModulo->value())
            ->whereNull('padre')->get();

        $collection = array();

        foreach ( $models as $model ){

            $OModel = new ModuloMenu(
                new NumericInteger($model->id),
                new Text($model->texto, false, -1 , ''),
                new Text($model->icono, true, -1 , ''),
                new NumericInteger($model->id_tipo_menu),
                new NumericInteger($model->padre),
                new Text($model->link, true, -1 , ''),
                new NumericInteger($model->id_modulo),
                new NumericInteger($model->id_estado->value),
                new Id($model->id_usu_registro, true , 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'La fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'La fecha de modificación no tiene el formato correcto')
            );

            $tipoMenu = '';
            switch ($model->id_tipo_menu){
                case EnumTipoMenu::Titulo->value: $tipoMenu = 'Titulo'; break;
                case EnumTipoMenu::SubMenu->value: $tipoMenu = 'Sub Menú'; break;
                case EnumTipoMenu::Link->value: $tipoMenu = 'Link'; break;
                case EnumTipoMenu::Subtitulo->value: $tipoMenu = 'Sub Título'; break;
                default: break;
            }

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setModulo(new Text(!is_null($model->modulo) ? $model->modulo->nombre  : null, false, -1));
            $OModel->setTipoMenu(new Text($tipoMenu, false, -1));

            $this->addHijos($OModel, $model->hijos);

            $collection[] = $OModel;
        }

        return $collection;
    }


    private function addHijos(ModuloMenu $padre, $hijos){
        $collection = [];
        if(!is_null($hijos)){
            foreach ($hijos as $model) {
                $OModel = new ModuloMenu(
                    new NumericInteger($model->id),
                    new Text($model->texto, false, -1 , ''),
                    new Text($model->icono, true, -1 , ''),
                    new NumericInteger($model->id_tipo_menu),
                    new NumericInteger($model->padre),
                    new Text($model->link, true, -1 , ''),
                    new NumericInteger($model->id_modulo),
                    new NumericInteger($model->id_estado->value),
                    new Id($model->id_usu_registro, true , 'El id del usuario que registro no tiene el formato correcto'),
                    new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                    new DateTimeFormat($model->f_registro, false, 'La fecha de registro no tiene el formato correcto'),
                    new DateTimeFormat($model->f_modifico, true, 'La fecha de modificación no tiene el formato correcto')
                );
                $tipoMenu = '';
                switch ($model->id_tipo_menu){
                    case EnumTipoMenu::Titulo->value: $tipoMenu = 'Titulo'; break;
                    case EnumTipoMenu::SubMenu->value: $tipoMenu = 'Sub Menú'; break;
                    case EnumTipoMenu::Link->value: $tipoMenu = 'Link'; break;
                    case EnumTipoMenu::Subtitulo->value: $tipoMenu = 'Sub Título'; break;
                    default: break;
                }


                $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
                $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
                $OModel->setModulo(new Text(!is_null($model->modulo) ? $model->modulo->nombre  : null, false, -1));
                $OModel->setTipoMenu(new Text($tipoMenu, false, -1));

                $collection[] = $OModel;
            }
        }
        $padre->setHijos($collection);

    }

    public function list(): array
    {
        $models = $this->eloquentModelModuloMenu->select(
            'id',
            'nombre',
            'link',
            'codigo',
            'id_estado',
            'id_eliminado',
        )->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ModuloMenuShort(
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
        $models = $this->eloquentModelModuloMenu->select(
            'id',
            'nombre',
            'link',
            'codigo',
            'id_estado',
            'id_eliminado',
        )->get();

        $collection = array();

        foreach ( $models as $model ){

            $OModel = new ModuloMenuShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1),
                new Text($model->link, true, -1),
                new Text($model->icono, false, -1),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $collection[] = $OModel;
        }

        $moduloPerfil = $this->eloquentModelPerfilModuloMenu->where('id_perfil',$idPerfil->value());
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
        $models = $this->eloquentModelModuloMenu->select(
            'id',
            'nombre',
            'link',
            'icono',
            'id_estado',
            'id_eliminado',
        )->get();

        $collection = array();

        foreach ( $models as $model ){

            $OModel = new ModuloMenuShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1),
                new Text($model->link, true, -1),
                new Text($model->icono, true, -1),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $collection[] = $OModel;
        }

        $moduloPerfil = $this->eloquentModelPerfilModuloMenu->where('id_perfil',$idPerfil->value());
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
        $this->eloquentModelModuloMenu->create([
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
        $this->eloquentModelModuloMenu->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'link' => $link->value(),
            'icono' => $icono->value(),
            'codigo' => $codigo->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idModuloMenu,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelModuloMenu->findOrFail($idModuloMenu->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idModuloMenu,
    ): ModuloMenu
    {
        $model = $this->eloquentModelModuloMenu->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->findOrFail($idModuloMenu->value());
        $OModel = new ModuloMenu(
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
