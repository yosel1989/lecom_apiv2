<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\EnumEstado;
use App\Enums\EnumModulo;
use App\Enums\EnumTipoMenu;
use App\Enums\IdEstado;
use Illuminate\Database\Seeder;

class ModuloMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Administración',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Titulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Dashboard',
            'icono'=> 'fa-duotone fa-grid-2',
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>null,
            'link'=> 'administracion/dashboard',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Registros',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Subtitulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Registro',
            'icono'=> 'fa-duotone fa-floppy-disk',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Vehiculos',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>4,
            'link'=>'administracion/vehiculos',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Personal',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>4,
            'link'=>'administracion/personal',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Sedes / Terminales',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>4,
            'link'=>'administracion/sedes',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Cajas',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>4,
            'link'=>'administracion/cajas',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Equipos POS',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>4,
            'link'=>'administracion/pos',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Serie (Comprobante)',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>4,
            'link'=>'administracion/comprobante-serie',
            'id_estado'=> IdEstado::Habilitado
        ]);


        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Seguridad',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Subtitulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Seguridad',
            'icono'=> 'fa-duotone fa-shield-quartered',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Administracion,
                'texto'=>'Peril',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>12,
                'link'=>'administracion/perfiles',
                'id_estado'=> IdEstado::Habilitado
            ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Administracion,
                'texto'=>'Usuarios',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>12,
                'link'=>'administracion/usuarios',
                'id_estado'=> IdEstado::Habilitado
            ]);


    }
}
