<?php

declare(strict_types=1);

namespace Src\V2\ClienteModuloMenu\Infrastructure\Repositories;

use App\Enums\EnumTipoMenu;
use App\Models\V2\ModuloMenu as EloquentModelModuloMenu;
use App\Models\V2\ClienteModuloMenu as EloquentModelClienteModuloMenu;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\ModuloMenu\Domain\ModuloMenu;
use Src\V2\ClienteModuloMenu\Domain\Contracts\ClienteModuloMenuRepositoryContract;

final class EloquentClienteModuloMenuRepository implements ClienteModuloMenuRepositoryContract
{
    private EloquentModelClienteModuloMenu $eloquent;
    private EloquentModelModuloMenu $eloquentModelModuloMenu;

    public function __construct()
    {
        $this->eloquent = new EloquentModelClienteModuloMenu;
        $this->eloquentModelModuloMenu = new EloquentModelModuloMenu;
    }


    public function collectionByCliente(Id $idCliente, NumericInteger $idModulo): array
    {

        $ids = [];
        $perfilMenu = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())
            ->where('id_modulo',$idModulo->value());
        $ids = $perfilMenu->count() > 0 ? $perfilMenu->first()->menu : [];
//        dd($ids);

        // Buscar los menus del modulo

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

            $OModel->setActivado( new ValueBoolean(in_array($model->id, $ids)) );

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

            $this->addHijos($OModel, $model->hijos, $ids);

            $collection[] = $OModel;
        }

        return $collection;

    }


    private function addHijos(ModuloMenu $padre, $hijos, array $idsActivos){
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

                $OModel->setActivado( new ValueBoolean(in_array($model->id, $idsActivos)) );


                $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
                $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
                $OModel->setModulo(new Text(!is_null($model->modulo) ? $model->modulo->nombre  : null, false, -1));
                $OModel->setTipoMenu(new Text($tipoMenu, false, -1));

                $collection[] = $OModel;
            }
        }
        $padre->setHijos($collection);

    }


    public function assign(
        Id $idCliente,
        NumericInteger $idModulo,
        array $menu,
        Id $idUsuario
    ): void
    {

        if($this->eloquent->where('id_cliente', $idCliente->value())->where('id_modulo', $idModulo->value())->count() > 0){
            $this->eloquent->where('id_cliente', $idCliente->value())->where('id_modulo', $idModulo->value())->update([
                'menu' => $menu,
                'id_usu_registro' => $idUsuario->value()
            ]);
        }else{
            $this->eloquent->create([
                'id_cliente' => $idCliente->value(),
                'id_modulo' => $idModulo->value(),
                'menu' => $menu,
                'id_usu_registro' => $idUsuario->value()
            ]);
        }

    }



}
