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
            'nombre' => 'Documento Nacional de Identidad',
            'nombre_corto' => 'DNI',
            'num_digitos' => 8,
        ]);

        \App\Models\V2\TipoDocumento::create([
            'nombre' => 'Ruc',
            'nombre_corto' => 'RUC',
            'num_digitos' => 11
        ]);

        \App\Models\V2\TipoDocumento::create([
            'nombre' => 'Carnet de Extranjeria',
            'nombre_corto' => 'CE',
            'num_digitos' => 20
        ]);

        \App\Models\V2\TipoDocumento::create([
            'nombre' => 'Pasaporte',
            'nombre_corto' => 'PAS',
            'num_digitos' => 20
        ]);
    }
}
