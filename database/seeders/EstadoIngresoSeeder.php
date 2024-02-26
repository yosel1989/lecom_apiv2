<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoIngresoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\EstadoIngreso::truncate();

        \App\Models\V2\EstadoIngreso::create([
            'nombre' => 'Activo',
        ]);

        \App\Models\V2\EstadoIngreso::create([
            'nombre' => 'Anulado',
        ]);

        \App\Models\V2\EstadoIngreso::create([
            'nombre' => 'Liquidado',
        ]);

    }
}
