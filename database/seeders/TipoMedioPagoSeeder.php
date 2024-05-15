<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoMedioPagoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\TipoMedioPago::truncate();
        \App\Models\V2\TipoMedioPago::create([
            'nombre' => 'Físico',
        ]);

        \App\Models\V2\TipoMedioPago::create([
            'nombre' => 'Digital',
        ]);
    }
}
