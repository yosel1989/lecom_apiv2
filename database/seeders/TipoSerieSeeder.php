<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoSerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\TipoSerie::create([
            'nombre'=> 'Boleto Interprovincial',
        ]);

        \App\Models\V2\TipoRuta::create([
            'nombre'=> 'Boleto Urbano',
        ]);



    }
}
