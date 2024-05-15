<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoCajaTrasladoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\EstadoCajaTraslado::truncate();

        \App\Models\V2\EstadoCajaTraslado::create([
            'nombre' => 'Activo',
        ]);

        \App\Models\V2\EstadoCajaTraslado::create([
            'nombre' => 'Anulado',
        ]);

    }
}
