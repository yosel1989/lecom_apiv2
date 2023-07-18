<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoRutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\TipoRuta::create([
            'nombre'=> 'Interprovincial',
        ]);

        \App\Models\V2\TipoRuta::create([
            'nombre'=> 'Urbano',
        ]);



    }
}
