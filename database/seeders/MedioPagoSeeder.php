<?php

namespace Database\Seeders;

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
            'bl_despacho' => true
        ]);

        \App\Models\V2\MedioPago::create([
            'nombre' => 'Tarjeta de Crédito',
        ]);

        \App\Models\V2\MedioPago::create([
            'nombre' => 'Yape',
            'bl_despacho' => true
        ]);

        \App\Models\V2\MedioPago::create([
            'nombre' => 'Cheque',
            'bl_despacho' => true
        ]);

        \App\Models\V2\MedioPago::create([
            'nombre' => 'Deposito Bancario',
            'bl_despacho' => true
        ]);
    }
}
