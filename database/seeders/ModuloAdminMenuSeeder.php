<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\EnumModulo;
use App\Enums\EnumTipoMenu;
use App\Enums\IdEstado;
use Illuminate\Database\Seeder;

class ModuloAdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /// Administración

        $menu = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Egresos',
            'icono'=>'fa-duotone fa-hand-holding-circle-dollar',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Categorias',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menu->id,
            'link'=>'administracion/egreso/categoria',
            'id_estado'=> IdEstado::Habilitado
        ]);
        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Tipos',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menu->id,
            'link'=> 'administracion/egreso/tipo',
            'id_estado'=> IdEstado::Habilitado
        ]);
        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Nuevo',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menu->id,
            'link'=> 'administracion/egreso/nuevo',
            'id_estado'=> IdEstado::Habilitado
        ]);


    }
}
