<?php

declare(strict_types=1);

namespace Database\Seeders;

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
        \App\Models\V2\ModuloMenu::truncate();


        /*********************************************************************************************
         * Administración
         */

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

        $menuRegistro = \App\Models\V2\ModuloMenu::create([
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
            'padre'=> $menuRegistro->id,
            'link'=>'administracion/vehiculos',
            'id_estado'=> IdEstado::Habilitado
        ]);

//        $menuVehiculoSalida =\App\Models\V2\ModuloMenu::create([
//            'id_modulo'=> EnumModulo::Administracion,
//            'texto'=>'Vehiculo | Salidas',
//            'icono'=>'fa-solid fa-arrows-turn-right',
//            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
//            'padre'=> null,
//            'link'=>null,
//            'id_estado'=> IdEstado::Habilitado
//        ]);

            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Administracion,
                'texto'=>'Cronogramas',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=> $menuRegistro->id,
                'link'=>'administracion/cronogramas',
                'id_estado'=> IdEstado::Habilitado
            ]);



        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Tipo Personal',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=> $menuRegistro->id,
            'link'=>'administracion/tipo-personal',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Personal',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=> $menuRegistro->id,
            'link'=>'administracion/personal',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Sedes / Terminales',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menuRegistro->id,
            'link'=>'administracion/sedes',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Cajas',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menuRegistro->id,
            'link'=>'administracion/cajas',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Equipos POS',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menuRegistro->id,
            'link'=>'administracion/pos',
            'id_estado'=> IdEstado::Habilitado
        ]);

        $menuComprobanteElectronico = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Comprobante Electrónico',
            'icono'=>'fa-duotone fa-receipt',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Empresas',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menuComprobanteElectronico->id,
            'link'=>'administracion/comprobante/empresa',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Series',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menuComprobanteElectronico->id,
            'link'=>'administracion/comprobante-serie',
            'id_estado'=> IdEstado::Habilitado
        ]);

        $menuEgresos = \App\Models\V2\ModuloMenu::create([
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
            'padre'=>$menuEgresos->id,
            'link'=>'administracion/egreso/categoria',
            'id_estado'=> IdEstado::Habilitado
        ]);
        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Tipos',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menuEgresos->id,
            'link'=> 'administracion/egreso/tipo',
            'id_estado'=> IdEstado::Habilitado
        ]);


        $menuIngresos = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Ingresos',
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
            'padre'=>$menuIngresos->id,
            'link'=>'administracion/ingreso/categoria',
            'id_estado'=> IdEstado::Habilitado
        ]);
        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Tipos',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menuIngresos->id,
            'link'=> 'administracion/ingreso/tipo',
            'id_estado'=> IdEstado::Habilitado
        ]);


//        \App\Models\V2\ModuloMenu::create([
//            'id_modulo'=> EnumModulo::Administracion,
//            'texto'=>'Nuevo',
//            'icono'=>null,
//            'id_tipo_menu'=> EnumTipoMenu::Link,
//            'padre'=>$menuEgresos->id,
//            'link'=> 'administracion/egreso/nuevo',
//            'id_estado'=> IdEstado::Habilitado
//        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Seguridad',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Subtitulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

        $menuSeguridad = \App\Models\V2\ModuloMenu::create([
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
                'texto'=>'Perfil',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuSeguridad->id,
                'link'=>'administracion/perfiles',
                'id_estado'=> IdEstado::Habilitado
            ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Administracion,
                'texto'=>'Usuarios',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuSeguridad->id,
                'link'=>'administracion/usuarios',
                'id_estado'=> IdEstado::Habilitado
            ]);
        $menuConfiguracion = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Administracion,
            'texto'=>'Configuración',
            'icono'=> 'fa-duotone fa-gear',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Administracion,
                'texto'=>'Medio Pago',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuConfiguracion->id,
                'link'=>'administracion/configuracion/medio-pago',
                'id_estado'=> IdEstado::Habilitado
            ]);

        /**********************************************************************************
         * Boletaje Interprovincial
         */

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::BoletajeInterprovincial,
            'texto'=>'Boletaje Interprovincial',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Titulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::BoletajeInterprovincial,
            'texto'=>'Dashboard',
            'icono'=> 'fa-duotone fa-grid-2',
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>null,
            'link'=> 'boletaje-interprovincial/dashboard',
            'id_estado'=> IdEstado::Habilitado
        ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::BoletajeInterprovincial,
            'texto'=>'Registros',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Subtitulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

        $menuRegistro = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::BoletajeInterprovincial,
            'texto'=>'Registro',
            'icono'=> 'fa-duotone fa-floppy-disk',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::BoletajeInterprovincial,
                'texto'=>'Rutas',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuRegistro->id,
                'link'=>'boletaje-interprovincial/rutas',
                'id_estado'=> IdEstado::Habilitado
            ]);

            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::BoletajeInterprovincial,
                'texto'=>'Paraderos',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuRegistro->id,
                'link'=>'boletaje-interprovincial/paraderos',
                'id_estado'=> IdEstado::Habilitado
            ]);

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::BoletajeInterprovincial,
            'texto'=>'Operaciones',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Subtitulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
        $menuOperaciones = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::BoletajeInterprovincial,
            'texto'=>'Operaciones',
            'icono'=> 'fa-duotone fa-floppy-disk',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);

                \App\Models\V2\ModuloMenu::create([
                    'id_modulo'=> EnumModulo::BoletajeInterprovincial,
                    'texto'=>'Venta de Boletos',
                    'icono'=>null,
                    'id_tipo_menu'=> EnumTipoMenu::Link,
                    'padre'=>$menuOperaciones->id,
                    'link'=>'boletaje-interprovincial/venta-boletos',
                    'id_estado'=> IdEstado::Habilitado
                ]);
                \App\Models\V2\ModuloMenu::create([
                    'id_modulo'=> EnumModulo::BoletajeInterprovincial,
                    'texto'=>'Encomienda',
                    'icono'=>null,
                    'id_tipo_menu'=> EnumTipoMenu::Link,
                    'padre'=>$menuOperaciones->id,
                    'link'=>'boletaje-interprovincial/registrar-encomienda',
                    'id_estado'=> IdEstado::Habilitado
                ]);


        /**********************************************************************************************
         * Reportes
         */

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Reportes,
            'texto'=>'Reportes',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Titulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
        $menuReporte1 = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Reportes,
            'texto'=>'Boletaje Interprovincial',
            'icono'=> 'fa-duotone fa-file-chart-column',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Reportes,
                'texto'=>'Reporte Total de Ventas',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuReporte1->id,
                'link'=>'reportes/boletaje-interprovincial/venta-total',
                'id_estado'=> IdEstado::Habilitado
            ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Reportes,
                'texto'=>'Reporte de Pasajeros',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuReporte1->id,
                'link'=>'reportes/boletaje-interprovincial/lista-pasajeros',
                'id_estado'=> IdEstado::Habilitado
            ]);
        $menuReporte2 = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Reportes,
            'texto'=>'Administración',
            'icono'=> 'fa-duotone fa-file-chart-column',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Reportes,
                'texto'=>'Reporte de Egresos',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuReporte2->id,
                'link'=>'reportes/administracion/egreso',
                'id_estado'=> IdEstado::Habilitado
            ]);

            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Reportes,
                'texto'=>'Reporte de Ingresos',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuReporte2->id,
                'link'=>'reportes/administracion/ingreso',
                'id_estado'=> IdEstado::Habilitado
            ]);

            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Reportes,
                'texto'=>'Reporte de Liquidaciones',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuReporte2->id,
                'link'=>'reportes/administracion/liquidacion',
                'id_estado'=> IdEstado::Habilitado
            ]);

            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Reportes,
                'texto' => 'Reporte de Caja | Saldo',
                'icono' => null,
                'id_tipo_menu' => EnumTipoMenu::Link,
                'padre' => $menuReporte2->id,
                'link' => 'reportes/administracion/caja/saldo',
                'id_estado' => IdEstado::Habilitado
            ]);

            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Reportes,
                'texto' => 'Reporte de Caja | Apertura / Cierre',
                'icono' => null,
                'id_tipo_menu' => EnumTipoMenu::Link,
                'padre' => $menuReporte2->id,
                'link' => 'reportes/administracion/caja/apertura-cierre',
                'id_estado' => IdEstado::Habilitado
            ]);

            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Reportes,
                'texto' => 'Reporte de Caja | Traslados',
                'icono' => null,
                'id_tipo_menu' => EnumTipoMenu::Link,
                'padre' => $menuReporte2->id,
                'link' => 'reportes/caja/traslados',
                'id_estado' => IdEstado::Habilitado
            ]);


        /**********************************************************************************************
         * Operaciones
         */

        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Operaciones,
            'texto'=>'Operaciones',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Titulo,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
        $menuOperaciones1 = \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Operaciones,
            'texto'=>'Administración',
            'icono'=> 'fa-duotone fa-file-chart-column',
            'id_tipo_menu'=> EnumTipoMenu::SubMenu,
            'padre'=>null,
            'link'=>null,
            'id_estado'=> IdEstado::Habilitado
        ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Operaciones,
                'texto'=>'Administrar Ingresos',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuOperaciones1->id,
                'link'=>'operaciones/ingresos',
                'id_estado'=> IdEstado::Habilitado
            ]);
        \App\Models\V2\ModuloMenu::create([
            'id_modulo'=> EnumModulo::Operaciones,
            'texto'=>'Administrar Egresos',
            'icono'=>null,
            'id_tipo_menu'=> EnumTipoMenu::Link,
            'padre'=>$menuOperaciones1->id,
            'link'=>'operaciones/egresos',
            'id_estado'=> IdEstado::Habilitado
        ]);
            \App\Models\V2\ModuloMenu::create([
                'id_modulo'=> EnumModulo::Operaciones,
                'texto'=>'Administrar Liquidaciones',
                'icono'=>null,
                'id_tipo_menu'=> EnumTipoMenu::Link,
                'padre'=>$menuOperaciones1->id,
                'link'=>'operaciones/liquidaciones',
                'id_estado'=> IdEstado::Habilitado
            ]);

    }
}
