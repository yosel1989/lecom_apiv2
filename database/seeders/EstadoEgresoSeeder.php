<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoEgresoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\EstadoEgreso::truncate();

        \App\Models\V2\EstadoEgreso::create([
            'nombre' => 'Activo',
        ]);

        \App\Models\V2\EstadoEgreso::create([
            'nombre' => 'Anulado',
        ]);

        \App\Models\V2\EstadoEgreso::create([
            'nombre' => 'Liquidado',
        ]);

    }
}
