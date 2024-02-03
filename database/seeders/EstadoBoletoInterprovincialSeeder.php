<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoBoletoInterprovincialSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\EstadoBoletoInteprovincial::truncate();

        \App\Models\V2\EstadoBoletoInteprovincial::create([
            'nombre' => 'Activo',
        ]);

        \App\Models\V2\EstadoBoletoInteprovincial::create([
            'nombre' => 'Anulado',
        ]);

        \App\Models\V2\EstadoBoletoInteprovincial::create([
            'nombre' => 'Liquidado',
        ]);

    }
}
