<?php

namespace Database\Seeders;

use App\Enums\EnumTipoMedioPago;
use Illuminate\Database\Seeder;

class MedioPagoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\MedioPago::truncate();
        \App\Models\V2\MedioPago::create([
            'nombre' => 'Efectivo',
            'bl_despacho' => true,
            'bl_entidad_financiera' => false,
            'id_tipo' => EnumTipoMedioPago::Fisico,
        ]);

        \App\Models\V2\MedioPago::create([
            'nombre' => 'Tarjeta de Crédito',
            'bl_despacho' => true,
            'bl_entidad_financiera' => true,
            'id_tipo' => EnumTipoMedioPago::Digital,
        ]);

        \App\Models\V2\MedioPago::create([
            'nombre' => 'Yape',
            'bl_despacho' => true,
            'bl_entidad_financiera' => false,
            'id_tipo' => EnumTipoMedioPago::Digital,
        ]);

        \App\Models\V2\MedioPago::create([
            'nombre' => 'Plin',
            'bl_despacho' => true,
            'bl_entidad_financiera' => false,
            'id_tipo' => EnumTipoMedioPago::Digital,
        ]);

    }
}
