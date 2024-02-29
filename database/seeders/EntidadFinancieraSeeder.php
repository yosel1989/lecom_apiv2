<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EntidadFinancieraSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\EntidadFinanciera::truncate();
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco de Comercio',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco de Crédito del Perú',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco Interamericano de Finanzas (BanBif)',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco Pichincha',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'BBVA',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Citibank Perú',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Interbank',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'MiBanco',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Scotiabank Perú',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco GNB Perú',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco Falabella',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco Ripley',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco Santander Perú',
        ]);
        \App\Models\V2\EntidadFinanciera::create([
            'nombre' => 'Banco de la Nación',
        ]);

    }
}
