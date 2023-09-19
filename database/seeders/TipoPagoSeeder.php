<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\TipoPago::create([
            'nombre' => 'Contado',
            'valor' => '1',
        ]);

        \App\Models\V2\TipoPago::create([
            'nombre' => 'Crédito',
            'valor' => '2'
        ]);
    }
}
