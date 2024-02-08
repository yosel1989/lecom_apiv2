<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoLiquidacionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\EstadoLiquidacion::truncate();

        \App\Models\V2\EstadoLiquidacion::create([
            'nombre' => 'Activo',
        ]);

        \App\Models\V2\EstadoLiquidacion::create([
            'nombre' => 'Anulado',
        ]);

    }
}
