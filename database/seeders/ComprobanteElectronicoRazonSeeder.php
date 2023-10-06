<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComprobanteElectronicoRazonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\ComprobanteElectronicoRazon::truncate();

        \App\Models\V2\ComprobanteElectronicoRazon::create([
            'nombre'=> 'Venta de Boleto Interprovincial',
        ]);
        \App\Models\V2\ComprobanteElectronicoRazon::create([
            'nombre'=> 'Encomienda',
        ]);

    }
}
