<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoMonedaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\TipoMoneda::create([
            'nombre' => 'Soles',
            'simbolo' => 'S/',
            'valor' => '1',
        ]);

    }
}
