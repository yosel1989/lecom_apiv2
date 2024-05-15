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
            'bl_punto_venta' => true,
            'bl_despacho' => true,
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Factura Electrónica',
            'abreviatura' => 'F/E.',
            'bl_punto_venta' => true,
            'bl_despacho' => true,
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Ticket de Venta',
            'abreviatura' => 'TCV.',
            'bl_punto_venta' => true,
            'bl_despacho' => true,
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Nota de Crédito',
            'abreviatura' => 'N/C',
            'bl_punto_venta' => false,
            'bl_despacho' => false,
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Nota de Débito',
            'abreviatura' => 'N/D',
            'bl_punto_venta' => false,
            'bl_despacho' => false,
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Comprobante de Egreso',
            'abreviatura' => 'TCE.',
            'bl_punto_venta' => false,
            'bl_despacho' => true,
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Comprobante de Ingreso',
            'abreviatura' => 'CI.',
            'bl_punto_venta' => false,
            'bl_despacho' => true,
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Comprobante de Traslado de Dinero',
            'abreviatura' => 'CTD.',
            'bl_punto_venta' => true,
            'bl_despacho' => false,
        ]);
    }
}
