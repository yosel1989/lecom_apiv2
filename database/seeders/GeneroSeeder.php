<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\Genero::truncate();

        \App\Models\V2\Genero::create([
            'nombre' => 'Masculino'
        ]);

        \App\Models\V2\Genero::create([
            'nombre' => 'Femenino'
        ]);

    }
}
