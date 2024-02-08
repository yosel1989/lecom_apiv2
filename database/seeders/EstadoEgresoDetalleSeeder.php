<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoEgresoDetalleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\EstadoEgresoDetalle::truncate();

        \App\Models\V2\EstadoEgresoDetalle::create([
            'nombre' => 'Activo',
        ]);

        \App\Models\V2\EstadoEgresoDetalle::create([
            'nombre' => 'Anulado',
        ]);

        \App\Models\V2\EstadoEgresoDetalle::create([
            'nombre' => 'Liquidado',
        ]);

    }
}
