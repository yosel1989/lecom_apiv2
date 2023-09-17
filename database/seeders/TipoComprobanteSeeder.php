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
        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Boleta',
            'blPuntoVenta' => true
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Factura',
            'blPuntoVenta' => true
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Ticket',
            'blPuntoVenta' => true
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Nota de Crédito',
            'blPuntoVenta' => false
        ]);

        \App\Models\V2\TipoComprobante::create([
            'nombre' => 'Nota de Débito',
            'blPuntoVenta' => false
        ]);
    }
}
