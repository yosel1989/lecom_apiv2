<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoCajaDiarioSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\EstadoCajaDiario::truncate();


        \App\Models\V2\EstadoCajaDiario::create([
            'nombre' => 'Abierto',
        ]);

        \App\Models\V2\EstadoCajaDiario::create([
            'nombre' => 'Cerrado',
        ]);


    }
}
