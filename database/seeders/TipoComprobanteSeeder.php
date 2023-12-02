<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoComprobanteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\TipoComprobante::truncate();

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Boleta de Venta Electrónica',
            'abreviatura' => 'B/V.',
            'bl_punto_venta' => true
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Factura Electrónica',
            'abreviatura' => 'F/E.',
            'bl_punto_venta' => true
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Ticket',
            'abreviatura' => 'TC.',
            'bl_punto_venta' => true
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Nota de Crédito',
            'abreviatura' => 'N/C',
            'bl_punto_venta' => false
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Nota de Débito',
            'abreviatura' => 'N/D',
            'bl_punto_venta' => false
        ]);
    }
}
