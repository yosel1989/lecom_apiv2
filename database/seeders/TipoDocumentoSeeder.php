<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\TipoDocumento::truncate();

        \App\Models\V2\TipoDocumento::create([
            'nombre' => 'Dni',
            'nombreCorto' => 'Dni',
            'numeroDigitos' => 8,
        ]);

        \App\Models\V2\TipoDocumento::create([
            'nombre' => 'Ruc',
            'nombreCorto' => 'Ruc',
            'numeroDigitos' => 11
        ]);

        \App\Models\V2\TipoDocumento::create([
            'nombre' => 'Carnet de Extranjeria',
            'nombreCorto' => 'Carnet de Extranjeria',
            'numeroDigitos' => 20
        ]);

        \App\Models\V2\TipoDocumento::create([
            'nombre' => 'Pasaporte',
            'nombreCorto' => 'Pasaporte',
            'numeroDigitos' => 20
        ]);
    }
}
